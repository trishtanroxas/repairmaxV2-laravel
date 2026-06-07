<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 animate-pulse">
        <div class="space-y-2.5">
            <div class="h-8 w-64 bg-gray-200 dark:bg-white/15 rounded-xl"></div>
            <div class="h-4 w-96 bg-gray-200 dark:bg-white/10 rounded-lg mt-2"></div>
        </div>
        <div class="h-11 w-36 bg-gray-200 dark:bg-white/15 rounded-lg shrink-0"></div>
    </div>

    <div class="bg-white dark:bg-white/3 rounded-2xl border border-brand-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-white/5 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-brand-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-5">Device</th>
                        <th class="px-6 py-5">Service Provided</th>
                        <th class="px-6 py-5">Date</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5">Final Cost</th>
                        <th class="px-6 py-5 text-right">Downloads</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-100 dark:divide-white/5 text-sm">
                    @for ($i = 0; $i < 5; $i++)
                        <tr class="animate-pulse">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-white/10 shrink-0"></div>
                                    <div class="space-y-1.5 flex-1">
                                        <div class="h-4 w-28 bg-gray-250 dark:bg-white/15 rounded"></div>
                                        <div class="h-3 w-36 bg-gray-200 dark:bg-white/10 rounded"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-24 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-20 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-6 w-16 bg-gray-200 dark:bg-white/10 rounded-lg"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="h-8 w-16 bg-gray-200 dark:bg-white/10 rounded-lg ml-auto"></div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
