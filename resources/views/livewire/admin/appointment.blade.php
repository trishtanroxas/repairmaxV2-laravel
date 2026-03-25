<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Appointments</h1>
            <p class="text-gray-500 mt-1">View all customer repair appointments.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">All Appointments</h2>
            <input type="text" placeholder="Search appointments..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Issue</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">iPhone 14 Pro</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">John Doe</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Screen Replacement</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Feb 25, 2026</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">Completed</span></td>
                        <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 font-bold text-sm">View</button></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">Galaxy S23</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Jane Smith</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Battery Replacement</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Feb 26, 2026</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-50 text-orange-700 border border-orange-100 rounded-lg text-xs font-bold">In Progress</span></td>
                        <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 font-bold text-sm">View</button></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">iPad Air</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Mike Johnson</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Water Damage Repair</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Feb 27, 2026</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-lg text-xs font-bold">Pending</span></td>
                        <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 font-bold text-sm">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
