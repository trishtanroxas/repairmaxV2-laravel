# Complete Database Location & How It Works

## 📍 Database Location

**File Path:** `C:\xampp\htdocs\repairmaxV2-laravel\database\database.sqlite`

This is a **SQLite database** file - a single database.sqlite file that stores ALL your data.

### What is SQLite?
- **Lightweight**: No server needed - it's just a file
- **Perfect for development**: Easy to backup (just copy the file)
- **Real**: Can hold millions of records
- **Can be upgraded**: If you need MySQL later, Laravel makes migration easy

---

## 🔧 How the Database Works

### Connection Configuration

**File:** `C:\xampp\htdocs\repairmaxV2-laravel\.env`

```
DB_CONNECTION=sqlite
DB_DATABASE=C:\xampp\htdocs\repairmaxV2-laravel\database\database.sqlite
```

This tells Laravel:
- "Use SQLite as the database driver"
- "The database file is located at database/database.sqlite"

---

## 📊 Database Tables & Structure

Your database currently has 11 tables:

```
┌─────────────────────────────────────────────────────────────┐
│                   DATABASE STRUCTURE                         │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│ 1. USERS (9 records) ────────────────────────────────────── │
│    └─ id, first_name, last_name, email, phone, password    │
│    └─ role (admin/user), is_active, is_verified            │
│    └─ Relationships: repairs, appointments, notifications   │
│                                                              │
│ 2. USER_PROFILES (5 records) ─────────────────────────────  │
│    └─ user_id, bio, date_of_birth, gender                  │
│    └─ notification_settings, status, timezone              │
│    └─ One profile per regular user                          │
│                                                              │
│ 3. ADMIN_PROFILES (4 records) ───────────────────────────── │
│    └─ user_id, admin_level, permissions, department        │
│    └─ job_title, created_by_id (which admin created it)    │
│    └─ One profile per admin user                            │
│                                                              │
│ 4. REPAIRS (15 records) ─────────────────────────────────── │
│    └─ user_id, tracking_code, device_name, issue_type      │
│    └─ status, quote, notes                                  │
│    └─ Linked to users (3 repairs per user)                  │
│                                                              │
│ 5. APPOINTMENTS (10 records) ─────────────────────────────  │
│    └─ user_id, tracking_code, device_brand, device_model   │
│    └─ pref_date, pref_time, status, description            │
│    └─ Linked to users (2 appointments per user)             │
│                                                              │
│ 6. NOTIFICATIONS (23 records) ───────────────────────────── │
│    └─ user_id (receiver), admin_id (sender, optional)       │
│    └─ title, message, type, is_read, read_at               │
│    └─ related_model, related_id (links to Repair/Appt)      │
│                                                              │
│ 7. ADMIN_ACTIVITY_LOGS ──────────────────────────────────── │
│    └─ admin_id, action, model_type, model_id                │
│    └─ changes (JSON), ip_address, user_agent                │
│    └─ Audit trail for all admin actions                     │
│                                                              │
│ 8. INVENTORY_ITEMS ──────────────────────────────────────── │
│    └─ name, category, sku, quantity, unit_price             │
│    └─ total_value (calculated: quantity * unit_price)       │
│    └─ Spare parts inventory management                      │
│                                                              │
│ 9. SETTINGS ─────────────────────────────────────────────── │
│    └─ key, value                                             │
│    └─ App-wide configuration settings                       │
│                                                              │
│ 10. CACHE & JOBS (Laravel system tables) ──────────────────│
│    └─ Manages caching and job queues                        │
│                                                              │
│ 11. MIGRATIONS (Laravel system table) ────────────────────  │
│    └─ Tracks which migrations have been run                 │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

---

## 💾 How Data is Stored

### Example: When a user books an appointment

```
1. User Inputs Data
   ↓
2. Data Sent to Laravel Controller
   ↓
3. Validation Happens
   ↓
4. Data is Saved to Database
   ├─ INSERT into appointments (device, date, time, user_id)
   ├─ INSERT into notifications (appointment_confirmation sent to user)
   └─ UPDATE admin_activity_logs (admin can see who made the booking)
   ↓
5. User Sees Confirmation
   ├─ Email sent (optional)
   └─ Notification created
```

---

## 🔄 How Relationships Work

### Users ↔ Repairs (One-to-Many)
```
One User has Many Repairs

User ID 1 (John) has:
  ├─ Repair #1 (iPhone screen)
  ├─ Repair #2 (Samsung battery)
  └─ Repair #3 (Laptop repair)

In Database:
repairs table:
  id | user_id | device_name
   1 |    1    | iPhone 14
   2 |    1    | Galaxy S21
   3 |    1    | MacBook
```

### Users ↔ Appointments (One-to-Many)
```
One User has Many Appointments

User ID 2 (Jane) has:
  ├─ Appointment #1 (Feb 25, 2026)
  └─ Appointment #2 (Mar 10, 2026)

In Database:
appointments table:
  id | user_id | pref_date
   1 |    2    | 2026-02-25
   2 |    2    | 2026-03-10
```

### Users ↔ Notifications (One-to-Many)
```
One User receives Many Notifications

User ID 1 (John) has notifications from:
  ├─ Admin about appointment confirmation
  ├─ Admin about repair status update
  └─ System about low inventory
```

---

## 🔐 Default User Accounts in Database

### Admin Accounts (Login these for testing)

1. **Super Admin** (Full Access)
   - Email: `repairmaxsample@gmail.com`
   - Password: `Admin@12345`
   - Role: admin
   - Admin Level: super_admin
   - Permissions: all

2. **Admin** (Standard Admin)
   - Email: `admin@repairmax.com`
   - Password: `password123`
   - Role: admin
   - Admin Level: admin
   - Permissions: manage_users, manage_repairs, manage_appointments, view_reports

3. **Moderator** (Support Only)
   - Email: `moderator@repairmax.com`
   - Password: `password123`
   - Role: admin
   - Admin Level: moderator
   - Permissions: view_users, view_repairs, respond_notifications

### Regular Users
- customer1@example.com through customer5@example.com
- Password: `password123` (all of them)
- Role: user

---

## 📱 How the App Interacts with Database

### Typical Data Flow

```
┌─────────────────┐
│  User Browser   │  (What user sees)
└────────┬────────┘
         │
         │ POST /appointments (submit form)
         ↓
┌──────────────────────┐
│  Laravel Routes      │  (routes/web.php)
└────────┬─────────────┘
         │
         ↓
┌──────────────────────┐
│  Livewire Components │  (app/Livewire/Admin/Appointment.php)
│  - Validates data    │
│  - Processes logic   │
└────────┬─────────────┘
         │
         ↓
┌──────────────────────┐
│  Eloquent Models     │  (app/Models/Appointment.php)
│  - Query builder     │
│  - Relationships     │
└────────┬─────────────┘
         │
         ↓
┌──────────────────────┐
│  Database (SQLite)   │  (database/database.sqlite)
│  - Stores appointment │
│  - Creates log entry │
│  - Creates notification
└────────┬─────────────┘
         │
         ↓
┌──────────────────────┐
│  Blade Views         │  (resources/views/)
│  - Shows success msg │
└────────┬─────────────┘
         │
         ↓
┌─────────────────┐
│  User Browser   │  (User sees "Success!")
└─────────────────┘
```

---

## 🛠️ How the Recent Features Work

### 1. Inventory Management (EDIT, DELETE, ADD)
```php
Flow:
User clicks "Edit" button
  ↓
wire:click="editItem($id)" fires
  ↓
InventoryManagement component loads item from DB
  ↓
Form shows with existing data
  ↓
User edits and clicks "Update"
  ↓
saveItem() method runs
  ↓
Item updated in database (UPDATE query)
  ↓
Session flash message shows
```

### 2. Appointment Viewing & Status Update
```php
Flow:
Admin clicks "View" on appointment
  ↓
wire:click="viewAppointment($id)" fires
  ↓
Appointment model loaded from DB with user relation
  ↓
Modal opens showing all appointment details
  ↓
Admin clicks status button (e.g., "Completed")
  ↓
updateStatus() method runs
  ↓
Appointment status updated in DB
  ↓
Notification created and sent to user
  ↓
Admin activity logged
```

### 3. Profile Save Changes
```php
Flow:
Admin types in profile fields
  ↓
wire:model binds each input to component property
  ↓
Clicks "Save Changes"
  ↓
saveChanges() validates all data
  ↓
Updates users table
  ↓
Updates user_profiles table
  ↓
Updates admin_profiles table
  ↓
Session flash "Profile updated!"
```

### 4. Export Report
```php
Flow:
Admin clicks "Export Repairs"
  ↓
exportReport() method runs
  ↓
Queries database for all repairs
  ↓
Generates CSV file content
  ↓
Creates temporary file in storage/app/temp/
  ↓
Browser downloads file
  ↓
Temporary file deleted automatically
```

---

## 📖 Common Database Queries Used

### Get all repairs for a user
```php
$user = User::find(1);
$repairs = $user->repairs()->get();
// Returns all repairs where user_id = 1
```

### Get appointment with customer info
```php
$appointment = Appointment::with('user')->find(1);
// Returns appointment with user name, email, phone attached
```

### Count notifications
```php
$unreadCount = Notification::where('user_id', 1)
                           ->where('is_read', false)
                           ->count();
// Returns number of unread notifications for user
```

### Update repair status
```php
$repair = Repair::find(1);
$repair->update(['status' => 'Completed']);
// Changes repair status in database
```

### Create notification
```php
Notification::create([
    'user_id' => 1,
    'admin_id' => 2,
    'title' => 'Repair Complete',
    'message' => 'Your repair is ready!',
    'type' => 'repair_completed',
]);
// Inserts new notification record
```

---

## 🔍 Accessing the Database Directly

### Method 1: Via Laravel Tinker (Command Line)
```bash
cd C:\xampp\htdocs\repairmaxV2-laravel
php artisan tinker

# Then type commands:
$users = App\Models\User::all();
$repairs = App\Models\Repair::where('status', 'Pending')->get();
$count = App\Models\Appointment::count();
```

### Method 2: Via SQLite Browser (GUI)
1. Download: https://sqlitebrowser.org/
2. Open `C:\xampp\htdocs\repairmaxV2-laravel\database\database.sqlite`
3. Browse tables visually
4. Execute SQL queries

### Method 3: Via Laravel's Query Builder
In any controller or Livewire component:
```php
$results = DB::table('repairs')->where('status', 'Pending')->get();
```

---

## ⚠️ Important Database Notes

1. **Backup Your Database**
   - Copy `database/database.sqlite` regularly
   - It's just one file - easy to backup!

2. **No Migrations Lost**
   - All migrations stored in `database/migrations/`
   - Database can be recreated at any time with:
     ```bash
     php artisan migrate:fresh --seed
     ```

3. **Test Data Always Available**
   - Run seeders anytime to repopulate test data
   - Doesn't affect code, only database content

4. **Real-World Production**
   - Switch to MySQL/PostgreSQL in .env when deploying
   - Same code, different database driver!

---

## ✅ Your Database is Ready!

Everything is working:
- ✓ Inventory EDIT, DELETE, ADD
- ✓ Appointments VIEW with modal
- ✓ Admin PROFILE SAVE
-  ✓ Reports EXPORT to CSV
- ✓ All data synced and connected
- ✓ Complete audit trail via activity logs
- ✓ Notifications working for all events

Happy building! 🚀
