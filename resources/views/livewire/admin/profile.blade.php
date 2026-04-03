<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Profile</h1>
            <p class="text-gray-500 mt-1">Manage your administrator account settings.</p>
        </div>
        <button class="inline-flex items-center gap-2 bg-gray-900 text-white hover:bg-gray-800 px-4 py-2 rounded-lg font-bold shadow-md transition-colors shrink-0">
            <span class="material-symbols-outlined text-[20px]">edit</span>
            Edit Profile
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <div class="text-center mb-6">
                    <img src="https://ui-avatars.com/api/?name=Admin+Repairmax&background=2563eb&color=ffffff&bold=true&size=120" 
                         alt="Profile" 
                         class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-blue-500">
                    <h2 class="text-xl font-bold text-gray-900">Admin Repairmax</h2>
                    <p class="text-sm text-gray-500">Administrator</p>
                </div>
                <div class="space-y-3 border-t border-gray-100 pt-6">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Email:</span>
                        <span class="text-sm font-medium text-gray-900">repairmaxsample@gmail.com</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Role:</span>
                        <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-lg text-xs font-bold">Admin</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center gap-1 text-sm font-medium text-green-600">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            Active
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Joined:</span>
                        <span class="text-sm font-medium text-gray-900">Jan 15, 2026</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Account Settings</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" value="Admin Repairmax" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" value="repairmaxsample@gmail.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" value="+63 912 345 6789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button class="px-6 py-2 bg-gray-900 text-white rounded-lg font-bold hover:bg-gray-800 transition-colors">Save Changes</button>
                        <button class="px-6 py-2 bg-white text-gray-900 border border-gray-300 rounded-lg font-bold hover:bg-gray-50 transition-colors">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400">lock</span>
                Change Password
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                    <input type="password" placeholder="Enter current password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" placeholder="Enter new password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" placeholder="Confirm new password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            <div class="flex justify-start mt-6">
                <button class="px-6 py-2 bg-gray-900 text-white rounded-lg font-bold hover:bg-gray-800 transition-colors">Update Password</button>
            </div>
        </div>
    </div>
</div>
