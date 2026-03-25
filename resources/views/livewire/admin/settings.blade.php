<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Settings</h1>
        <p class="text-gray-500 mt-1">Manage all system and business configuration settings.</p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <span class="text-green-700 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div x-data="{ activeTab: 'general' }" class="mb-6">
        <div class="bg-white border-b border-gray-200 rounded-t-2xl overflow-hidden">
            <div class="flex flex-wrap gap-0 px-6">
                <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'border-b-2 border-blue-600 text-blue-600' : 'border-b-2 border-transparent text-gray-600 hover:text-gray-900'" class="px-4 py-4 font-medium transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">business</span>
                        General
                    </span>
                </button>
                <button @click="activeTab = 'email'" :class="activeTab === 'email' ? 'border-b-2 border-blue-600 text-blue-600' : 'border-b-2 border-transparent text-gray-600 hover:text-gray-900'" class="px-4 py-4 font-medium transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">mail</span>
                        Email
                    </span>
                </button>
                <button @click="activeTab = 'notifications'" :class="activeTab === 'notifications' ? 'border-b-2 border-blue-600 text-blue-600' : 'border-b-2 border-transparent text-gray-600 hover:text-gray-900'" class="px-4 py-4 font-medium transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        Notifications
                    </span>
                </button>
                <button @click="activeTab = 'payment'" :class="activeTab === 'payment' ? 'border-b-2 border-blue-600 text-blue-600' : 'border-b-2 border-transparent text-gray-600 hover:text-gray-900'" class="px-4 py-4 font-medium transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">payment</span>
                        Payment
                    </span>
                </button>
                <button @click="activeTab = 'hours'" :class="activeTab === 'hours' ? 'border-b-2 border-blue-600 text-blue-600' : 'border-b-2 border-transparent text-gray-600 hover:text-gray-900'" class="px-4 py-4 font-medium transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">schedule</span>
                        Hours
                    </span>
                </button>
                <button @click="activeTab = 'security'" :class="activeTab === 'security' ? 'border-b-2 border-blue-600 text-blue-600' : 'border-b-2 border-transparent text-gray-600 hover:text-gray-900'" class="px-4 py-4 font-medium transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">security</span>
                        Security
                    </span>
                </button>
            </div>
        </div>

        <!-- General Settings Tab -->
        <div x-show="activeTab === 'general'" class="bg-white rounded-b-2xl border border-t-0 border-gray-200 p-6 space-y-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Business Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Name</label>
                    <input type="text" wire:model="businessName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" wire:model="businessEmail" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" wire:model="businessPhone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                    <input type="url" wire:model="businessWebsite" placeholder="https://example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                    <input type="text" wire:model="businessAddress" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <input type="text" wire:model="businessCity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                    <input type="text" wire:model="businessState" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Zip/Postal Code</label>
                    <input type="text" wire:model="businessZipCode" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="saveGeneralSettings" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Save Changes</button>
            </div>
        </div>

        <!-- Email Settings Tab -->
        <div x-show="activeTab === 'email'" class="bg-white rounded-b-2xl border border-t-0 border-gray-200 p-6 space-y-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Email Configuration</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                    <input type="text" wire:model="smtpHost" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                    <input type="number" wire:model="smtpPort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Email Address</label>
                    <input type="email" wire:model="emailFromAddress" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Name</label>
                    <input type="text" wire:model="emailFromName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" wire:model="emailNotificationsEnabled" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                        <span class="text-sm font-medium text-gray-700">Enable Email Notifications</span>
                    </label>
                </div>
            </div>
            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="saveEmailSettings" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Save Changes</button>
            </div>
        </div>

        <!-- Notifications Settings Tab -->
        <div x-show="activeTab === 'notifications'" class="bg-white rounded-b-2xl border border-t-0 border-gray-200 p-6 space-y-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Notification Preferences</h2>
            <div class="space-y-4">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="appointmentReminders" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Send Appointment Reminders</span>
                </label>
                <div class="ml-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reminder Time (hours before appointment)</label>
                    <select wire:model="appointmentReminderTime" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="1">1 hour</option>
                        <option value="6">6 hours</option>
                        <option value="12">12 hours</option>
                        <option value="24">24 hours</option>
                        <option value="48">48 hours</option>
                    </select>
                </div>
                <label class="flex items-center gap-3 cursor-pointer mt-4">
                    <input type="checkbox" wire:model="statusUpdateNotifications" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Send Status Update Notifications</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="adminAlerts" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Send Admin Alerts for New Orders</span>
                </label>
            </div>
            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="saveNotificationSettings" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Save Changes</button>
            </div>
        </div>

        <!-- Payment Settings Tab -->
        <div x-show="activeTab === 'payment'" class="bg-white rounded-b-2xl border border-t-0 border-gray-200 p-6 space-y-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Payment Gateway Configuration</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Gateway</label>
                    <select wire:model="paymentGateway" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="stripe">Stripe</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency Code</label>
                    <input type="text" wire:model="currencyCode" placeholder="PHP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tax Percentage (%)</label>
                    <input type="number" wire:model="taxPercentage" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="savePaymentSettings" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Save Changes</button>
            </div>
        </div>

        <!-- Business Hours Tab -->
        <div x-show="activeTab === 'hours'" class="bg-white rounded-b-2xl border border-t-0 border-gray-200 p-6 space-y-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Business Operating Hours</h2>
            <div class="space-y-4">
                @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        <label class="w-24 text-sm font-medium text-gray-700 capitalize">{{ $day }}</label>
                        <input type="time" wire:model="{{ $day }}Open" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
                        <span class="text-gray-500">to</span>
                        <input type="time" wire:model="{{ $day }}Close" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
                        @if($day === 'sunday')
                            <span class="text-xs text-gray-500 ml-2">(Leave empty if closed)</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="saveBusinessHours" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Save Changes</button>
            </div>
        </div>

        <!-- Security Settings Tab -->
        <div x-show="activeTab === 'security'" class="bg-white rounded-b-2xl border border-t-0 border-gray-200 p-6 space-y-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Security Configuration</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Password Length</label>
                    <input type="number" wire:model="passwordMinLength" min="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (minutes)</label>
                    <input type="number" wire:model="sessionTimeout" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Login Attempts</label>
                    <input type="number" wire:model="maxLoginAttempts" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Expiry (days)</label>
                    <input type="number" wire:model="passwordExpireDays" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="space-y-3 py-4 border-y border-gray-200">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="passwordRequireNumbers" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Require numbers in passwords</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="passwordRequireSpecialChars" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Require special characters in passwords</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="twoFactorAuthRequired" class="w-5 h-5 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" />
                    <span class="text-sm font-medium text-gray-700">Require 2-Factor Authentication for admin accounts</span>
                </label>
            </div>
            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button wire:click="saveSecuritySettings" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">Save Changes</button>
            </div>
        </div>
    </div>
</div>
