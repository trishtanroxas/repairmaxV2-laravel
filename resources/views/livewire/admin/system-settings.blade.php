<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">System Settings</h1>
            <p class="text-gray-500 mt-1">Configure system-wide application settings.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-800 font-medium">✓ {{ session('success') }}</p>
        </div>
    @endif

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">System Configuration</h2>
            </div>
            <div class="p-6 space-y-6">
                <!-- Maintenance Mode Toggle -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Maintenance Mode</p>
                        <p class="text-xs text-gray-500 mt-1">Enable/disable application access for users</p>
                    </div>
                    <button wire:click="toggleMaintenance"
                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $maintenanceMode ? 'bg-red-600' : 'bg-gray-300' }} focus:outline-none">
                        <span :class="$maintenanceMode ? 'translate-x-6' : 'translate-x-1'"
                            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                    </button>
                </div>

                <!-- Email Notifications Toggle -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Email Notifications</p>
                        <p class="text-xs text-gray-500 mt-1">Send system notifications to administrators</p>
                    </div>
                    <button wire:click="toggleEmailNotifications"
                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $emailNotifications ? 'bg-blue-600' : 'bg-gray-300' }} focus:outline-none">
                        <span :class="$emailNotifications ? 'translate-x-6' : 'translate-x-1'"
                            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                    </button>
                </div>

                <!-- Data Backup Toggle -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Data Backup</p>
                        <p class="text-xs text-gray-500 mt-1">Automatic daily backups at scheduled time</p>
                    </div>
                    <button wire:click="toggleDataBackup"
                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $dataBackup ? 'bg-blue-600' : 'bg-gray-300' }} focus:outline-none">
                        <span :class="$dataBackup ? 'translate-x-6' : 'translate-x-1'"
                            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                    </button>
                </div>

                <!-- Backup Time Setting -->
                <div class="pb-6 border-b border-gray-100">
                    <label class="block text-sm font-medium text-gray-900 mb-2">Backup Schedule Time</label>
                    <input type="time" wire:model="autoBackupTime"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    <p class="text-xs text-gray-500 mt-2">{{ $dataBackup ? '✓ Backup enabled at ' . $autoBackupTime : '✗ Backup disabled' }}</p>
                </div>

                <!-- System Version Info -->
                <div class="pb-6">
                    <p class="text-sm font-medium text-gray-900">System Version</p>
                    <p class="text-lg font-bold text-gray-900 mt-2">{{ $systemVersion }}</p>
                    <p class="text-xs text-gray-500 mt-1">Latest: 1.0.0</p>
                </div>
            </div>

            <!-- Save Button -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex gap-3">
                <button wire:click="saveSettings"
                    class="px-6 py-2 bg-gray-900 text-white rounded-lg font-bold hover:bg-gray-800 transition-colors">
                    Save Settings
                </button>
                <button
                    class="px-6 py-2 bg-white text-gray-900 border border-gray-300 rounded-lg font-bold hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
