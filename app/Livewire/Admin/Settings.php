<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;

#[Layout('components.layouts.admin')]
#[Title('Settings | Repairmax')]
class Settings extends Component
{
    // General Settings
    public $businessName = 'Repairmax';
    public $businessEmail = 'repairmaxsample@gmail.com';
    public $businessPhone = '+63 2 1234 5678';
    public $businessAddress = '123 Main Street, Business District, City';
    public $businessCity = '';
    public $businessState = '';
    public $businessZipCode = '';
    public $businessWebsite = '';
    public $businessLogo = '';

    // Email Settings
    public $smtpHost = 'smtp.gmail.com';
    public $smtpPort = '587';
    public $smtpUsername = '';
    public $smtpPassword = '';
    public $emailFromAddress = '';
    public $emailFromName = 'Repairmax';
    public $emailNotificationsEnabled = true;

    // Notification Settings
    public $appointmentReminders = true;
    public $appointmentReminderTime = '24'; // hours before
    public $statusUpdateNotifications = true;
    public $adminAlerts = true;

    // Payment Settings
    public $paymentGateway = 'stripe'; // stripe, paypal
    public $stripePublicKey = '';
    public $stripeSecretKey = '';
    public $paypalClientId = '';
    public $paypalClientSecret = '';
    public $currencyCode = 'PHP';
    public $taxPercentage = 0;

    // SMS Settings
    public $smsEnabled = false;
    public $smsTwilioSid = '';
    public $smsTwilioToken = '';
    public $smsFromNumber = '';

    // Business Hours
    public $mondayOpen = '08:00';
    public $mondayClose = '18:00';
    public $tuesdayOpen = '08:00';
    public $tuesdayClose = '18:00';
    public $wednesdayOpen = '08:00';
    public $wednesdayClose = '18:00';
    public $thursdayOpen = '08:00';
    public $thursdayClose = '18:00';
    public $fridayOpen = '08:00';
    public $fridayClose = '18:00';
    public $saturdayOpen = '09:00';
    public $saturdayClose = '16:00';
    public $sundayOpen = '';
    public $sundayClose = '';

    // Security Settings
    public $passwordMinLength = 8;
    public $passwordRequireNumbers = true;
    public $passwordRequireSpecialChars = true;
    public $passwordExpireDays = 90;
    public $twoFactorAuthRequired = false;
    public $sessionTimeout = 60; // minutes
    public $maxLoginAttempts = 5;

    // Integration Settings
    public $googleAnalyticsId = '';
    public $slackWebhookUrl = '';
    public $apiRateLimit = 1000;
    public $apiLoggingEnabled = true;

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        // Load from database if exists
        $settings = Setting::all()->keyBy('key');
        
        foreach ($settings as $key => $setting) {
            if (property_exists($this, $key)) {
                $this->{$key} = $setting->value;
            }
        }
    }

    public function saveGeneralSettings()
    {
        Setting::set('businessName', $this->businessName, 'general');
        Setting::set('businessEmail', $this->businessEmail, 'general');
        Setting::set('businessPhone', $this->businessPhone, 'general');
        Setting::set('businessAddress', $this->businessAddress, 'general');
        Setting::set('businessCity', $this->businessCity, 'general');
        Setting::set('businessState', $this->businessState, 'general');
        Setting::set('businessZipCode', $this->businessZipCode, 'general');
        Setting::set('businessWebsite', $this->businessWebsite, 'general');
        
        session()->flash('success', 'General settings saved successfully!');
    }

    public function saveEmailSettings()
    {
        Setting::set('smtpHost', $this->smtpHost, 'email');
        Setting::set('smtpPort', $this->smtpPort, 'email');
        Setting::set('emailFromAddress', $this->emailFromAddress, 'email');
        Setting::set('emailFromName', $this->emailFromName, 'email');
        Setting::set('emailNotificationsEnabled', $this->emailNotificationsEnabled, 'email');
        
        session()->flash('success', 'Email settings saved successfully!');
    }

    public function saveNotificationSettings()
    {
        Setting::set('appointmentReminders', $this->appointmentReminders, 'notifications');
        Setting::set('appointmentReminderTime', $this->appointmentReminderTime, 'notifications');
        Setting::set('statusUpdateNotifications', $this->statusUpdateNotifications, 'notifications');
        Setting::set('adminAlerts', $this->adminAlerts, 'notifications');
        
        session()->flash('success', 'Notification settings saved successfully!');
    }

    public function savePaymentSettings()
    {
        Setting::set('paymentGateway', $this->paymentGateway, 'payment');
        Setting::set('currencyCode', $this->currencyCode, 'payment');
        Setting::set('taxPercentage', $this->taxPercentage, 'payment');
        
        session()->flash('success', 'Payment settings saved successfully!');
    }

    public function saveBusinessHours()
    {
        $hours = [
            'monday' => ['open' => $this->mondayOpen, 'close' => $this->mondayClose],
            'tuesday' => ['open' => $this->tuesdayOpen, 'close' => $this->tuesdayClose],
            'wednesday' => ['open' => $this->wednesdayOpen, 'close' => $this->wednesdayClose],
            'thursday' => ['open' => $this->thursdayOpen, 'close' => $this->thursdayClose],
            'friday' => ['open' => $this->fridayOpen, 'close' => $this->fridayClose],
            'saturday' => ['open' => $this->saturdayOpen, 'close' => $this->saturdayClose],
            'sunday' => ['open' => $this->sundayOpen, 'close' => $this->sundayClose],
        ];
        
        Setting::set('businessHours', $hours, 'business');
        
        session()->flash('success', 'Business hours saved successfully!');
    }

    public function saveSecuritySettings()
    {
        Setting::set('passwordMinLength', $this->passwordMinLength, 'security');
        Setting::set('passwordRequireNumbers', $this->passwordRequireNumbers, 'security');
        Setting::set('passwordRequireSpecialChars', $this->passwordRequireSpecialChars, 'security');
        Setting::set('passwordExpireDays', $this->passwordExpireDays, 'security');
        Setting::set('twoFactorAuthRequired', $this->twoFactorAuthRequired, 'security');
        Setting::set('sessionTimeout', $this->sessionTimeout, 'security');
        Setting::set('maxLoginAttempts', $this->maxLoginAttempts, 'security');
        
        session()->flash('success', 'Security settings saved successfully!');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
