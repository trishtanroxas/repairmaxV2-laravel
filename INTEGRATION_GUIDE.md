# Quick Integration Guide for Admin Panel

## 🎯 How to Use the Database in Your Livewire Components

### 1. Displaying User List in Admin Panel

**Livewire Component:**
```php
<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    public function render()
    {
        // Get all users with their profiles
        $users = User::where('role', 'user')
            ->with('profile', 'repairs', 'appointments')
            ->paginate(10);

        return view('livewire.admin.manage-users', compact('users'));
    }
}
?>
```

**Blade View:**
```blade
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Repairs</th>
                <th>Appointments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->getFullName() }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    @if($user->profile->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td>{{ $user->repairs()->count() }}</td>
                <td>{{ $user->appointments()->count() }}</td>
                <td>
                    <a href="#" wire:click="editUser({{ $user->id }})">Edit</a>
                    <a href="#" wire:click="viewProfile({{ $user->id }})">Profile</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
```

---

### 2. Admin Management (Create/Edit Admins)

**Livewire Component:**
```php
<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\AdminProfile;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ManageAdmins extends Component
{
    public $email;
    public $first_name;
    public $last_name;
    public $admin_level = 'admin';
    public $department;

    public function createAdmin()
    {
        // Validate input
        $this->validate([
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        // Create user with admin role
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make('tempPassword123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create admin profile
        $user->adminProfile()->create([
            'admin_level' => $this->admin_level,
            'department' => $this->department,
            'permissions' => $this->getDefaultPermissions(),
            'created_by_id' => auth()->id(),
        ]);

        // Log the action
        AdminActivityLog::log(
            auth()->id(),
            'created',
            'User',
            $user->id,
            ['admin_level' => $this->admin_level]
        );

        session()->flash('message', 'Admin created successfully!');
        $this->reset(['email', 'first_name', 'last_name']);
    }

    private function getDefaultPermissions()
    {
        return match($this->admin_level) {
            'super_admin' => ['all'],
            'admin' => ['manage_users', 'manage_repairs', 'manage_appointments', 'view_reports'],
            'moderator' => ['view_users', 'view_repairs', 'respond_notifications'],
            default => []
        };
    }

    public function render()
    {
        // Display all admins
        $admins = User::where('role', 'admin')
            ->with('adminProfile')
            ->paginate(10);

        return view('livewire.admin.manage-admins', compact('admins'));
    }
}
?>
```

---

### 3. User Profile Management

**Livewire Component:**
```php
<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{
    public $userId;
    public $user;
    public $profile;
    public $bio;
    public $gender;
    public $timezone;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::with('profile')->find($userId);
        $this->profile = $this->user->profile;
        
        if($this->profile) {
            $this->bio = $this->profile->bio;
            $this->gender = $this->profile->gender;
            $this->timezone = $this->profile->timezone;
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'bio' => 'nullable|max:500',
            'gender' => 'nullable|in:male,female,other',
            'timezone' => 'required',
        ]);

        $this->profile->update([
            'bio' => $this->bio,
            'gender' => $this->gender,
            'timezone' => $this->timezone,
        ]);

        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
?>
```

---

### 4. Notification Display and Management

**Livewire Component:**
```php
<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class NotificationCenter extends Component
{
    public $unreadCount;
    public $notifications;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $this->unreadCount = auth()->user()->getUnreadNotificationsCount();
        $this->notifications = auth()->user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if($notification && $notification->user_id === auth()->id()) {
            $notification->markAsRead();
            $this->loadNotifications();
        }
    }

    public function markAllAsRead()
    {
        auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notification-center');
    }
}
?>
```

---

### 5. Repair Status Tracking

**Livewire Component:**
```php
<?php

namespace App\Livewire;

use App\Models\Repair;
use App\Models\Notification;
use Livewire\Component;

class TrackRepair extends Component
{
    public $tracking_code;
    public $repair;

    public function search()
    {
        $this->repair = Repair::where('tracking_code', $this->tracking_code)
            ->with('user')
            ->first();

        if(!$this->repair) {
            session()->flash('error', 'Repair not found');
        }
    }

    public function updateStatus($newStatus)
    {
        $this->repair->update(['status' => $newStatus]);

        // Send notification to user
        Notification::create([
            'user_id' => $this->repair->user_id,
            'admin_id' => auth()->id(),
            'title' => 'Repair Status Updated',
            'message' => "Your repair status is now: {$newStatus}",
            'type' => 'repair_update',
            'related_model' => 'Repair',
            'related_id' => $this->repair->id,
        ]);

        session()->flash('message', 'Status updated and user notified');
    }

    public function render()
    {
        return view('livewire.track-repair');
    }
}
?>
```

---

## 📊 Database Query Examples

### Get Dashboard Statistics for Admin
```php
// In your controller or Livewire component
$stats = [
    'total_users' => User::where('role', 'user')->count(),
    'active_repairs' => Repair::whereIn('status', ['Pending', 'In Progress'])->count(),
    'scheduled_appointments' => Appointment::where('status', 'scheduled')->count(),
    'pending_notifications' => Notification::where('is_read', false)->count(),
    'unverified_users' => User::where('is_verified', false)->count(),
];
```

### Get User's Complete Information
```php
$user = User::with([
    'profile',
    'repairs' => fn($q) => $q->orderBy('created_at', 'desc'),
    'appointments' => fn($q) => $q->orderBy('pref_date', 'desc'),
    'notifications' => fn($q) => $q->where('is_read', false)
])->find($userId);
```

### Find Which Admin Created a New Admin
```php
$admin = User::with(['adminProfile' => function($q) {
    $q->with('createdBy'); // Get the admin who created this
}])->find($adminId);

echo "Created by: " . $admin->adminProfile->createdBy->getFullName();
```

---

## 📝 SQL Queries for Direct Database Access

### View All Users with Their Repair Count
```sql
SELECT u.id, u.first_name, u.last_name, u.email, 
       COUNT(r.id) as repair_count,
       up.status
FROM users u
LEFT JOIN user_profiles up ON u.id = up.user_id
LEFT JOIN repairs r ON u.id = r.user_id
WHERE u.role = 'user'
GROUP BY u.id
```

### Get Active Admin Accounts
```sql
SELECT u.id, u.first_name, u.last_name, u.email,
       ap.admin_level, ap.department
FROM users u
INNER JOIN admin_profiles ap ON u.id = ap.user_id
WHERE u.role = 'admin' AND u.is_active = 1
```

### Find Unread Notifications for a User
```sql
SELECT * FROM notifications
WHERE user_id = ? AND is_read = 0
ORDER BY created_at DESC
```

---

## 🔄 Workflow Examples

### Complete Admin Creation Workflow
1. Create user in `users` table (role='admin')
2. Create admin profile in `admin_profiles` table
3. Log action in `admin_activity_logs` table
4. Send notification to other admins about new admin
5. Send email with temporary password to new admin

### Complete Repair Status Update Workflow
1. Update repair status in `repairs` table
2. Create notification in `notifications` table
3. Update appointment status if applicable
4. Log admin action in `admin_activity_logs` table
5. Send email/SMS notification to user (optional)

---

All databases are fully synced and ready to use! 🚀
