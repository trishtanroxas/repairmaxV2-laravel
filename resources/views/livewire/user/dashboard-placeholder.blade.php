<div class="w-full">
    {{-- Header Skeleton --}}
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 animate-pulse">
        <div class="space-y-2.5">
            <div class="h-8 w-64 bg-gray-200 dark:bg-white/15 rounded-xl"></div>
            <div class="h-4 w-96 bg-gray-200 dark:bg-white/10 rounded-lg"></div>
        </div>
        <div class="h-11 w-32 bg-gray-200 dark:bg-white/15 rounded-lg shrink-0"></div>
    </div>

    {{-- Stats Cards Skeleton --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @for ($i = 0; $i < 4; $i++)
            <div class="animate-pulse bg-white dark:bg-white/3 border border-brand-200 dark:border-white/10 p-5 rounded-2xl flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-200 dark:bg-white/10 rounded-xl shrink-0"></div>
                <div class="flex-1 space-y-2.5">
                    <div class="h-3 bg-gray-200 dark:bg-white/10 rounded w-2/3"></div>
                    <div class="h-6 bg-gray-250 dark:bg-white/15 rounded w-1/3"></div>
                </div>
            </div>
        @endfor
    </div>

    {{-- Table Skeleton --}}
    <div class="bg-white dark:bg-white/3 rounded-2xl border border-brand-200 dark:border-white/10 shadow-sm overflow-hidden w-full">
        <div class="px-6 py-5 border-b border-brand-100 dark:border-white/5 flex items-center justify-between animate-pulse">
            <div class="h-5 w-40 bg-gray-200 dark:bg-white/15 rounded-lg"></div>
            <div class="h-4 w-16 bg-gray-200 dark:bg-white/10 rounded-lg hidden sm:block"></div>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap min-w-[800px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-brand-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4">Device</th>
                        <th class="px-6 py-4">Service Required</th>
                        <th class="px-6 py-4">Date Submitted</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Quote</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-100 dark:divide-white/5 text-sm">
                    @for ($i = 0; $i < 5; $i++)
                        <tr class="animate-pulse">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-white/10 shrink-0"></div>
                                    <div class="h-4 w-32 bg-gray-250 dark:bg-white/15 rounded"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-28 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-20 bg-gray-200 dark:bg-white/10 rounded"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-6 w-16 bg-gray-200 dark:bg-white/10 rounded-lg"></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-4 w-16 bg-gray-205 dark:bg-white/15 rounded"></div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="h-8 w-16 bg-gray-200 dark:bg-white/10 rounded-xl ml-auto"></div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
