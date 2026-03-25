<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Support Tickets</h1>
            <p class="text-gray-500 mt-1">Manage customer support tickets and issues.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Open Tickets</h2>
            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm">
                <option>All Tickets</option>
                <option>Open</option>
                <option>In Progress</option>
                <option>Resolved</option>
            </select>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Ticket ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">#TKT001</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">John Doe</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Device not working after repair</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-50 text-orange-700 border border-orange-100 rounded-lg text-xs font-bold">Open</span></td>
                        <td class="px-6 py-4"><span class="inline-flex px-2.5 py-1 bg-red-50 text-red-700 rounded text-xs font-bold">High</span></td>
                        <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 font-bold text-sm">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
