# Create Admin Feature - Testing & Troubleshooting

## Quick Test Steps

1. **Open User Management Page**
   - Login as admin: admin@repairmax.com / password123
   - Go to `/admin/user-management`

2. **Click "Create Admin" Button**
   - Look for green "Create Admin" button at top right
   - Modal should pop up

3. **Fill the Form**
   - Email: `newtestadmin@example.com`
   - First Name: TestAdmin
   - Last Name: User
   - Phone: 555-0000
   - Department: IT Support
   - Admin Level: Admin
   - Password: SecurePass123

4. **Click "Create Admin" Button**
   - Form should submit
   - You should see success message

---

## If It Doesn't Work - Debug Steps

### Check 1: Are you logged in as an Admin?
```
- Current page should show "/admin/user-management"
- Logout and login again with:
  Email: admin@repairmax.com
  Password: password123
```

### Check 2: Look for Error Messages
- Check if modal shows red error messages
- Check if green/red banner appears at top
- If you see error messages, note them down

### Check 3: Check Browser Console
- Press F12 to open Developer Tools
- Go to Console tab
- Look for any red error messages
- Look for Livewire errors

### Check 4: Check Laravel Logs
```bash
# Open this file to see error logs:
storage/logs/laravel.log

# Or tail the logs in real-time:
tail -f storage/logs/laravel.log
```

### Check 5: Try without special characters
- Remove phone/department (make them simpler)
- Use simple password without special chars
- Try with shorter names

---

## What Should Happen

### ✅ Success Flow:
1. Fill form with valid data
2. Click "Create Admin"
3. Modal closes automatically
4. Green success banner appears at top showing:
   - "✅ Admin created successfully! Email: [email] | Password: [pwd]"
5. New admin appears in the users table below

### ❌ Error Flow:
1. Fill form with invalid data (like duplicate email)
2. Click "Create Admin"
3. Error messages appear in red inside the modal under the fields
4. Modal stays open
5. You can fix errors and try again

---

## Expected Database Behavior

When admin is created successfully:
1. New record added to `users` table with:
   - role = 'admin'
   - is_active = true
   - is_verified = true
   - email + password hashed

2. New record added to `admin_profiles` table with:
   - user_id = (new user's id)
   - admin_level = (selected level)
   - permissions as JSON
   - created_by_id = (your id)

3. Notifications sent to other admins showing:
   - Title: "New Admin Created"
   - Message: "A new admin account has been created: [Name]"

4. New admin can now login with email + password

---

## Manual Test via Database

If you want to verify the database was actually updated:

```bash
# Check users table
SELECT id, email, role, is_active FROM users WHERE role='admin' ORDER BY id DESC LIMIT 1;

# Check admin_profiles table
SELECT user_id, admin_level, department FROM admin_profiles ORDER BY user_id DESC LIMIT 1;

# Check notifications
SELECT * FROM notifications WHERE title LIKE 'New Admin%' ORDER BY id DESC LIMIT 1;
```

---

## Common Issues & Fixes

### Issue: Form doesn't submit
**Fix**: 
- Press F5 to refresh page
- Clear browser cache (Ctrl+Shift+Delete)
- Try different browser

### Issue: Email already exists error
**Fix**:
- Use completely unique email address
- Format: firstname.lastname@example.com

### Issue: Modal closes but nothing happens
**Fix**:
- Check browser console (F12) for JavaScript errors
- Check Laravel logs: `storage/logs/laravel.log`
- Try creating with simpler data (no special chars)

### Issue: "remember_token" error
**Fix**:
- This means User model fillable array is missing 'remember_token'
- Check that I updated the User model correctly
- Should be in `app/Models/User.php` line 32

---

## Need Help?

If the feature still doesn't work:

1. **Check the logs**: `tail storage/logs/laravel.log`
2. **Check form validation**: Try with minimal data
3. **Verify database**: Make sure `users` and `admin_profiles` tables exist
4. **Reload Livewire**: Clear browser cache and refresh

The create admin feature should now work properly with:
- ✅ Better error messages
- ✅ Form validation
- ✅ Database logging
- ✅ Success notifications
- ✅ Proper modal handling
