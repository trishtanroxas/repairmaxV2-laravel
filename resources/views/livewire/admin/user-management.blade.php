<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">User Management</h1>
            <p class="text-gray-500 mt-1">Manage all registered users and their access levels.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900">Active Users ({{ count($users) }})</h2>
                <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                    <input type="text" wire:model.live="search" placeholder="Search users..." 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    <select wire:model.live="filterRole" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="all">All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background=2563eb&color=fff" 
                                        class="w-8 h-8 rounded-full" />
                                    <span class="font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $user->email }}</span></td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $user->phone ?? 'N/A' }}</span></td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-1 {{ $user->role === 'admin' ? 'bg-red-50 text-red-700' : 'bg-blue-50 text-blue-700' }} rounded text-xs font-bold">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 text-sm font-medium text-green-600">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-sm font-medium text-red-600">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($user->is_active)
                                    <button wire:click="blockUser({{ $user->id }})" class="text-red-600 hover:text-red-800 font-bold">Block</button>
                                @else
                                    <button wire:click="unblockUser({{ $user->id }})" class="text-green-600 hover:text-green-800 font-bold">Unblock</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <span class="material-symbols-outlined text-5xl text-gray-300 block mb-2">person_off</span>
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>