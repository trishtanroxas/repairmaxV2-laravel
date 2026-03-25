<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Appointment Management</h1>
            <p class="text-gray-500 mt-1">Manage and update appointment statuses.</p>
        </div>
        <button class="inline-flex items-center gap-2 bg-gray-900 text-white hover:bg-gray-800 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
            <span class="material-symbols-outlined text-[20px]">add</span>
            New Appointment
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Manage Appointments</h2>
            <div class="flex gap-2">
                <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option>All Status</option>
                    <option>Completed</option>
                    <option>In Progress</option>
                    <option>Pending</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Assigned To</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">#APT001</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">iPhone 14</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">John Doe</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Feb 25</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Mike Tech</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">Completed</span></td>
                        <td class="px-6 py-4">
                            <button class="text-blue-600 hover:text-blue-800 font-bold text-sm mr-3">Edit</button>
                            <button class="text-red-600 hover:text-red-800 font-bold text-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
