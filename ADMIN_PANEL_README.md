# Repairmax Admin Panel Documentation

## 📋 Overview
The admin panel provides comprehensive management tools for Repairmax business operations, including user management, appointment scheduling, inventory tracking, reporting, and system configuration.

---

## 🗂️ Admin Panel Structure

### **Folder Organization**

```
app/Livewire/Admin/           # Backend logic components
├── Dashboard.php             # Main admin dashboard with real-time statistics
├── SystemOverview.php        # System overview and key metrics
├── Profile.php               # Admin profile management
├── Settings.php              # Business and email configuration
├── SystemSettings.php        # System maintenance, backups, monitoring
├── Appointment.php           # View appointments overview
├── AppointmentManagement.php # Manage, edit, delete appointments
├── Inventory.php             # View inventory status
├── InventoryManagement.php   # Manage inventory items, stock levels
├── UserManagement.php        # Manage user accounts, roles, permissions
├── Messages.php              # System messages
├── MessagesSupport.php       # Support tickets and customer inquiries
├── Reports.php               # Business reports and data analysis
└── ReportsAnalytics.php      # Advanced analytics and insights

resources/views/livewire/admin/       # Frontend templates
├── dashboard.blade.php
├── system-overview.blade.php
├── profile.blade.php
├── settings.blade.php                # Tabbed interface for all settings
├── system-settings.blade.php
├── appointment.blade.php
├── appointment-management.blade.php
├── inventory.blade.php
├── inventory-management.blade.php
├── user-management.blade.php         # User list with search/filter
├── messages.blade.php
├── messages-support.blade.php
├── reports.blade.php
└── reports-analytics.blade.php

resources/views/components/layouts/
└── admin.blade.php                   # Main admin layout with sidebar

routes/web.php                        # Admin route definitions (admin/* routes)
```

---

## 📌 Sidebar Navigation

The admin panel sidebar is organized into 7 main sections:

### **1. Main**
- **Dashboard** - Real-time overview with key metrics
- **Overview** - Detailed system overview
- **Profile** - Admin account details

### **2. Appointments**
- **Appointments** - View all appointment bookings
- **Management** - Create, edit, delete appointments

### **3. Inventory**
- **Inventory** - Current stock levels and status
- **Management** - Manage parts, components, stock quantities

### **4. Users**
- **User Management** - Manage all users, roles, permissions, block/unblock accounts

### **5. Communications**
- **Messages** - System messages and notifications
- **Support Tickets** - Customer support inquiries

### **6. Reporting**
- **Reports** - Business performance reports
- **Analytics** - Advanced data analytics and insights

### **7. System**
- **Settings** - Business configuration (6 tabs with full settings)
- **System** - System maintenance, maintenance mode, backups, monitoring

---

## ⚙️ Settings Page (Comprehensive)

Located at `/admin/settings`, the Settings page is organized into **6 main tabs**:

### **Tab 1: General Settings**
- Business Name
- Business Email & Phone
- Website URL
- Complete Address (Street, City, State, Zip)

### **Tab 2: Email Configuration**
- SMTP Host, Port, Authentication
- From Email Address & Display Name
- Email Notifications Toggle

### **Tab 3: Notification Preferences**
- Appointment Reminders (configurable timing)
- Status Update Notifications
- Admin Alerts for New Orders

### **Tab 4: Payment Gateway**
- Payment Provider Selection (Stripe/PayPal)
- Currency Code Configuration
- Tax Percentage Settings

### **Tab 5: Business Operating Hours**
- Set hours for each day of the week
- Support for closed days (e.g., Sunday)
- Real-time hour picker inputs

### **Tab 6: Security Configuration**
- Password Policy (length, complexity requirements)
- Session Timeout Duration
- Maximum Login Attempts
- Password Expiry Settings
- 2-Factor Authentication Toggle

---

## 📊 Key Components Status

| Component | Status | Features |
|-----------|--------|----------|
| **Dashboard** | ✅ Production Ready | Real data loading, key metrics |
| **User Management** | ✅ Production Ready | Search, filter, block/unblock users |
| **System Settings** | ✅ Production Ready | Toggle switches, real Livewire binding |
| **Settings** | ✅ Production Ready | 6 tabbed sections with full persistence |
| **Appointments** | 🔄 In Progress | Basic view implemented, CRUD pending |
| **Inventory** | 🔄 In Progress | Basic view implemented, CRUD pending |
| **Messages** | 🔄 In Progress | Static view, functionality pending |
| **Support** | 🔄 In Progress | Static view, functionality pending |
| **Reports** | 🔄 In Progress | Static view, functionality pending |
| **Analytics** | 🔄 In Progress | Static view, functionality pending |

---

## 🔗 Database Models

### **Core Models**
- `User` - User accounts with roles (admin, user)
- `Appointment` - Service appointments
- `Repair` - Repair records
- `Setting` - System and business settings (persistent)

### **Settings Categories**
Settings are organized by category:
- `general` - Business information
- `email` - Email/SMTP configuration
- `notifications` - Notification behavior
- `payment` - Payment gateway settings
- `business` - Business hours and operations
- `security` - Security policies

---

## 🛠️ Implementation Guide

### **Adding a New Setting**

1. Add property to `App\Livewire\Admin\Settings` class
2. Add database column via migration OR use JSON storage
3. Add form field in `settings.blade.php`
4. Create save method: `public function saveCategory()` with `Setting::set()`
5. Add wire:click binding to Save button

**Example:**
```php
// In Settings.php
public $newSetting = 'default_value';

public function saveNewSetting() {
    Setting::set('newSetting', $this->newSetting, 'category_name');
    session()->flash('success', 'Setting saved!');
}

// In settings.blade.php
<input type="text" wire:model="newSetting" />
<button wire:click="saveNewSetting">Save</button>
```

### **Using Settings in Code**

```php
// In any component or controller
use App\Models\Setting;

$businessName = Setting::get('businessName', 'Repairmax');
$taxRate = Setting::get('taxPercentage', 0);
```

---

## 🔐 Security Features

- ✅ Admin-only routes with middleware protection
- ✅ Role-based access control
- ✅ Session management and timeouts
- ✅ Password policies enforced
- ✅ 2FA support ready
- ✅ Login attempt limiting

---

## 📱 Responsive Design

All admin pages feature:
- ✅ Mobile-responsive layout
- ✅ Sidebar collapse on mobile
- ✅ Optimized touch targets
- ✅ Adaptive grid layouts
- ✅ Full-screen support on tablets

---

## 🚀 Next Steps (TODO)

1. **Appointment Management**
   - Implement CRUD operations
   - Add form validation
   - Status workflow management

2. **Inventory Management**
   - Database queries for items
   - Stock level tracking
   - Low stock alerts

3. **User Management Enhancements**
   - User creation/editing
   - Role assignment
   - Permission management

4. **Reporting & Analytics**
   - Revenue reports
   - Performance metrics
   - Export functionality

5. **Notifications**
   - Real-time message system
   - Toast notifications
   - Email integration

---

## 📞 Support

For questions about admin panel functionality, refer to:
- Component files for business logic
- Blade templates for UI structure
- Database seeders for default values
- Route definitions in `routes/web.php`

Last Updated: March 26, 2026
