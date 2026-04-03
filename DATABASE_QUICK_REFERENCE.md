# Database Quick Reference

## 🔑 All Tables at a Glance

| Table Name | Purpose | Key Fields | Links To |
|------------|---------|-----------|----------|
| **users** | User & admin accounts | id, email, role, password | repairs, appointments, profiles, notifications |
| **user_profiles** | User details & preferences | user_id, bio, status, timezone | users (1:1) |
| **admin_profiles** | Admin account details | user_id, admin_level, permissions | users (1:1) |
| **repairs** | Device repair records | user_id, tracking_code, status | users (M:1) |
| **appointments** | Service bookings | user_id, tracking_code, device_model | users (M:1) |
| **notifications** | Messages & alerts | user_id, admin_id, title, is_read | users (M:1) |
| **admin_activity_logs** | Admin action audit trail | admin_id, action, model_type | users (M:1) |
| **inventory_items** | Spare parts inventory | name, quantity, price | — |
| **settings** | App-wide settings | key, value | — |

---

## 🔗 Relationship Map

```
USER RELATIONSHIPS:

User (admin account)
  ├── AdminProfile (1:1)
  │   ├── Permissions (JSON)
  │   ├── Admin Level (super/admin/mod)
  │   └── Created By (points to another User)
  ├── ActivityLogs (1:M)
  │   └── Track of all actions this admin performed
  └── SentNotifications (1:M)
      └── Notifications sent by this admin

User (regular account)
  ├── UserProfile (1:1)
  │   ├── Bio, Gender, Preferences
  │   ├── Status (active/inactive/suspended)
  │   └── Notification settings
  ├── Repairs (1:M)
  │   ├── Tracking code
  │   ├── Device info
  │   └── Status & Quote
  ├── Appointments (1:M)
  │   ├── Device details
  │   ├── Preferred date/time
  │   └── Status
  └── Notifications (1:M)
      ├── From admins
      ├── About repairs/appointments
      └── Read/unread status
```

---

## 📦 User Role Hierarchy

```
SUPER_ADMIN (repairmaxsample@gmail.com)
  ├─ Can create/delete admins
  ├─ Can create/delete users
  ├─ Can view all activity logs
  ├─ Can manage everything
  └─ Permissions: ['all']

ADMIN (admin@repairmax.com)
  ├─ Can create moderators
  ├─ Can manage users
  ├─ Can manage repairs
  ├─ Can send notifications
  └─ Permissions: ['manage_users', 'manage_repairs', 'manage_appointments', 'view_reports']

MODERATOR (moderator@repairmax.com)
  ├─ Can view users
  ├─ Can view repairs
  ├─ Can respond to notifications
  └─ Permissions: ['view_users', 'view_repairs', 'respond_notifications']

REGULAR_USER (customer1-5@example.com)
  ├─ Can view their own profile
  ├─ Can create/view repairs
  ├─ Can schedule/view appointments
  ├─ Can view notifications
  └─ Permissions: none (but can be customized)
```

---

## 🎯 Common Queries (Laravel Eloquent)

### Users
```php
// Get admin with full details
User::with('adminProfile')->find($id);

// Get regular user with all relations
User::with('profile', 'repairs', 'appointments', 'notifications')->find($id);

// Count users by status
User::where('role', 'user')->with('profile')
    ->whereHas('profile', fn($q) => $q->where('status', 'active'))
    ->count();

// Get all active admins
User::where('role', 'admin')->where('is_active', true)->with('adminProfile')->get();
```

### Repairs
```php
// Get user's repairs
$user->repairs()->paginate(10);

// Find repair by tracking code
Repair::where('tracking_code', 'RM-00001')->first();

// Count repairs by status
Repair::where('user_id', $id)->groupBy('status')->count();

// Get completed repairs
Repair::where('status', 'Completed')->with('user')->get();
```

### Appointments
```php
// Get user's appointments
$user->appointments()->orderBy('pref_date')->get();

// Get scheduled appointments
Appointment::where('status', 'scheduled')->with('user')->get();

// Appointments for specific date
Appointment::whereDate('pref_date', today())->get();
```

### Notifications
```php
// Get user's unread notifications
Notification::where('user_id', $id)->where('is_read', false)->get();

// Get notification count
$user->notifications()->where('is_read', false)->count();

// Mark as read
$notification->markAsRead();

// Recent notifications
Notification::where('user_id', $id)->latest()->limit(10)->get();
```

### Admin Activity Logs
```php
// Get admin's activity
AdminActivityLog::where('admin_id', $adminId)->latest()->get();

// Get all changes made to a user
AdminActivityLog::where('model_type', 'User')
                 ->where('model_id', $userId)->get();

// Recent admin actions
AdminActivityLog::latest()->limit(20)->get();
```

---

## 💄 Status Values (Enums)

### User Profile Status
- `active` - User account is active
- `inactive` - User account is inactive
- `suspended` - User account is suspended (temporary)

### Repair Status
- `Pending` - Awaiting technician
- `In Progress` - Currently being repaired
- `Completed` - Repair finished

### Appointment Status
- `pending` - Not yet confirmed
- `scheduled` - Confirmed appointment
- `completed` - Service completed
- `cancelled` - Appointment cancelled

### Notification Type
- `appointment_confirmation` - Appointment booked
- `repair_update` - Repair status change
- `repair_completed` - Repair done
- `admin_alert` - Alert for admins
- `system_alert` - System notification

### Admin Level
- `super_admin` - Full system access
- `admin` - Manager level access
- `moderator` - Support level access

---

## 📊 Data Statistics

Current test data:
- 9 Total Users
- 4 Admin accounts
- 5 Regular users
- 15 Repairs (3 per user)
- 10 Appointments (2 per user)
- 23 Notifications
- 5 User Profiles
- 4 Admin Profiles

---

## ✨ Features Available

✓ User management (create, edit, suspend)
✓ Admin account creation & management
✓ Complete profile system (user + admin)
✓ Role-based access control
✓ Real-time notifications
✓ Repair tracking with status
✓ Appointment scheduling
✓ Activity logging for admins
✓ Permission system
✓ User status management

---

## 🚀 Ready for Development!

All database connections are complete and tested. Ready to:
- ✅ Build Livewire components
- ✅ Create admin panel UI
- ✅ Implement notification system
- ✅ Build user dashboard
- ✅ Add reports/analytics

Start using the INTEGRATION_GUIDE.md for code examples! 💪
