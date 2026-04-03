<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\AdminProfile;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@repairmax.com',
            'phone' => '+1-555-0001',
            'password' => Hash::make('password123'),
            'address' => '123 Admin Street',
            'city' => 'Admin City',
            'state' => 'AC',
            'postal_code' => '10001',
            'role' => 'admin',
            'is_verified' => true,
            'is_active' => true,
            'profile_picture' => null,
        ]);

        // Create super admin profile
        $superAdmin->adminProfile()->create([
            'admin_level' => 'super_admin',
            'department' => 'Management',
            'job_title' => 'System Administrator',
            'permissions' => ['all'],
            'notes' => 'System root administrator',
        ]);

        // Create regular admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@repairmax.com',
            'phone' => '+1-555-0002',
            'password' => Hash::make('password123'),
            'address' => '456 Admin Avenue',
            'city' => 'Admin Town',
            'state' => 'AT',
            'postal_code' => '10002',
            'role' => 'admin',
            'is_verified' => true,
            'is_active' => true,
        ]);

        // Create admin profile
        $admin->adminProfile()->create([
            'admin_level' => 'admin',
            'department' => 'Operations',
            'job_title' => 'Operations Manager',
            'permissions' => ['manage_users', 'manage_repairs', 'manage_appointments', 'view_reports'],
            'created_by_id' => $superAdmin->id,
            'notes' => 'Main operations admin',
        ]);

        // Create moderator
        $moderator = User::create([
            'first_name' => 'Moderator',
            'last_name' => 'Staff',
            'email' => 'moderator@repairmax.com',
            'phone' => '+1-555-0003',
            'password' => Hash::make('password123'),
            'address' => '789 Support Street',
            'city' => 'Support City',
            'state' => 'SC',
            'postal_code' => '10003',
            'role' => 'admin',
            'is_verified' => true,
            'is_active' => true,
        ]);

        // Create moderator profile
        $moderator->adminProfile()->create([
            'admin_level' => 'moderator',
            'department' => 'Support',
            'job_title' => 'Support Moderator',
            'permissions' => ['view_users', 'view_repairs', 'respond_notifications'],
            'created_by_id' => $superAdmin->id,
            'notes' => 'Customer support moderator',
        ]);

        // Create regular users
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'first_name' => "Customer",
                'last_name' => "User{$i}",
                'email' => "customer{$i}@example.com",
                'phone' => "+1-555-100{$i}",
                'password' => Hash::make('password123'),
                'address' => "{$i}00 Customer Street",
                'city' => "City {$i}",
                'state' => 'ST',
                'postal_code' => "1000{$i}",
                'role' => 'user',
                'is_verified' => true,
                'is_active' => true,
            ]);

            // Create user profile
            $user->profile()->create([
                'bio' => "I am a regular customer looking for repair services.",
                'date_of_birth' => '1990-0' . $i . '-15',
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'alternative_phone' => "+1-555-200{$i}",
                'emergency_contact' => "Emergency Person {$i}",
                'email_notifications' => true,
                'sms_notifications' => $i % 2 == 0,
                'push_notifications' => true,
                'status' => 'active',
                'preferred_language' => 'en',
                'timezone' => 'UTC',
            ]);
        }
    }
}
