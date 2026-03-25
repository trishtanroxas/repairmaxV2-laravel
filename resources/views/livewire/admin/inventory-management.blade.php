<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Inventory Management</h1>
            <p class="text-gray-500 mt-1">Add, edit, and manage inventory items.</p>
        </div>
        <button class="inline-flex items-center gap-2 bg-gray-900 text-white hover:bg-gray-800 px-4 py-2 rounded-lg font-bold shadow-md transition-colors">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Add Item
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">All Inventory Items</h2>
            <input type="text" placeholder="Search inventory..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Item</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Unit Price</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total Value</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">iPhone Screen</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">SKU-IP14-SCR</span></td>
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">45</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">₱2,500</span></td>
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">₱112,500</span></td>
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
