<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Inventory</h1>
            <p class="text-gray-500 mt-1">Track repair parts and equipment stock levels.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Items</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">548</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">box</span>
                </div>
            </div>
            <p class="text-sm text-blue-600 font-medium">SKU items in stock</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Low Stock</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">12</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">warning</span>
                </div>
            </div>
            <p class="text-sm text-yellow-600 font-medium">Items need reorder</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Out of Stock</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">3</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">block</span>
                </div>
            </div>
            <p class="text-sm text-red-600 font-medium">Critical attention</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Value</p>
                    <h3 class="text-3xl font-extrabold text-gray-900 mt-1">₱125k</h3>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined text-2xl">price_tag</span>
                </div>
            </div>
            <p class="text-sm text-green-600 font-medium">Total inventory value</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Inventory Items</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Item Name</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">iPhone Screen</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Screens</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">SKU-IP14-SCR</span></td>
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">45</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">₱2,500</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-lg text-xs font-bold">In Stock</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">Galaxy Battery</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">Batteries</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">SKU-GS23-BAT</span></td>
                        <td class="px-6 py-4"><span class="font-medium text-gray-900">8</span></td>
                        <td class="px-6 py-4"><span class="text-gray-600">₱950</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-lg text-xs font-bold">Low Stock</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
