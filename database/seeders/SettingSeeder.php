<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            // General Settings
            ['key' => 'businessName', 'value' => 'Repairmax', 'category' => 'general'],
            ['key' => 'businessEmail', 'value' => 'repairmaxsample@gmail.com', 'category' => 'general'],
            ['key' => 'businessPhone', 'value' => '+63 2 1234 5678', 'category' => 'general'],
            ['key' => 'businessAddress', 'value' => '123 Main Street, Business District, City', 'category' => 'general'],
            ['key' => 'businessCity', 'value' => 'Manila', 'category' => 'general'],
            ['key' => 'businessState', 'value' => 'NCR', 'category' => 'general'],
            ['key' => 'businessZipCode', 'value' => '1000', 'category' => 'general'],
            ['key' => 'businessWebsite', 'value' => 'https://repairmax.com', 'category' => 'general'],
            
            // Email Settings
            ['key' => 'smtpHost', 'value' => 'smtp.gmail.com', 'category' => 'email'],
            ['key' => 'smtpPort', 'value' => '587', 'category' => 'email'],
            ['key' => 'emailFromAddress', 'value' => 'repairmaxsample@gmail.com', 'category' => 'email'],
            ['key' => 'emailFromName', 'value' => 'Repairmax', 'category' => 'email'],
            ['key' => 'emailNotificationsEnabled', 'value' => true, 'category' => 'email'],
            
            // Notifications
            ['key' => 'appointmentReminders', 'value' => true, 'category' => 'notifications'],
            ['key' => 'appointmentReminderTime', 'value' => '24', 'category' => 'notifications'],
            ['key' => 'statusUpdateNotifications', 'value' => true, 'category' => 'notifications'],
            ['key' => 'adminAlerts', 'value' => true, 'category' => 'notifications'],
            
            // Payment
            ['key' => 'paymentGateway', 'value' => 'stripe', 'category' => 'payment'],
            ['key' => 'currencyCode', 'value' => 'PHP', 'category' => 'payment'],
            ['key' => 'taxPercentage', 'value' => '0', 'category' => 'payment'],
            
            // Business Hours
            ['key' => 'businessHours', 'value' => json_encode([
                'monday' => ['open' => '08:00', 'close' => '18:00'],
                'tuesday' => ['open' => '08:00', 'close' => '18:00'],
                'wednesday' => ['open' => '08:00', 'close' => '18:00'],
                'thursday' => ['open' => '08:00', 'close' => '18:00'],
                'friday' => ['open' => '08:00', 'close' => '18:00'],
                'saturday' => ['open' => '09:00', 'close' => '16:00'],
                'sunday' => ['open' => '', 'close' => ''],
            ]), 'category' => 'business'],
            
            // Security
            ['key' => 'passwordMinLength', 'value' => '8', 'category' => 'security'],
            ['key' => 'passwordRequireNumbers', 'value' => true, 'category' => 'security'],
            ['key' => 'passwordRequireSpecialChars', 'value' => true, 'category' => 'security'],
            ['key' => 'passwordExpireDays', 'value' => '90', 'category' => 'security'],
            ['key' => 'twoFactorAuthRequired', 'value' => false, 'category' => 'security'],
            ['key' => 'sessionTimeout', 'value' => '60', 'category' => 'security'],
            ['key' => 'maxLoginAttempts', 'value' => '5', 'category' => 'security'],
        ];

        foreach ($defaults as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'category' => $setting['category'],
                ]
            );
        }
    }
}
