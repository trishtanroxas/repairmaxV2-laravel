<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 animate-pulse">
        <div class="space-y-2.5">
            <div class="h-8 w-64 bg-gray-200 dark:bg-white/15 rounded-xl"></div>
            <div class="h-4 w-96 bg-gray-200 dark:bg-white/10 rounded-lg"></div>
        </div>
        <div class="h-11 w-44 bg-gray-200 dark:bg-white/15 rounded-lg shrink-0"></div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @for ($i = 0; $i < 2; $i++)
            <div class="animate-pulse bg-white dark:bg-white/3 border border-brand-200 dark:border-white/10 rounded-2xl overflow-hidden shadow-sm">
                <!-- Card Header Skeleton -->
                <div class="p-6 border-b border-brand-100 dark:border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 rounded-xl bg-gray-200 dark:bg-white/10 shrink-0"></div>
                        <div class="space-y-2 flex-1">
                            <div class="h-5 w-40 bg-gray-250 dark:bg-white/15 rounded-lg"></div>
                            <div class="h-3.5 w-24 bg-gray-200 dark:bg-white/10 rounded"></div>
                        </div>
                    </div>
                    <div class="h-7 w-24 bg-gray-200 dark:bg-white/10 rounded-lg shrink-0"></div>
                </div>

                <!-- Card Body Skeleton -->
                <div class="p-6 bg-gray-50/30 dark:bg-transparent space-y-6">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded bg-gray-200 dark:bg-white/10"></div>
                        <div class="h-4 w-60 bg-gray-200 dark:bg-white/10 rounded"></div>
                    </div>

                    <!-- Details Box Skeleton -->
                    <div class="grid grid-cols-3 gap-4 bg-white dark:bg-white/3 p-4 rounded-xl border border-brand-200 dark:border-white/10 shadow-sm">
                        <div class="space-y-1.5">
                            <div class="h-2 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                            <div class="h-4 w-20 bg-gray-250 dark:bg-white/15 rounded"></div>
                        </div>
                        <div class="space-y-1.5">
                            <div class="h-2 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                            <div class="h-4 w-12 bg-gray-250 dark:bg-white/15 rounded"></div>
                        </div>
                        <div class="space-y-1.5">
                            <div class="h-2 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                            <div class="h-4 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                        </div>
                    </div>

                    <!-- Pricing Breakdown Skeleton -->
                    <div class="bg-white dark:bg-white/3 p-4 rounded-xl border border-brand-200 dark:border-white/10 shadow-sm space-y-3">
                        <div class="h-2 w-24 bg-gray-200 dark:bg-white/10 rounded"></div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <div class="h-3.5 w-28 bg-gray-200 dark:bg-white/10 rounded"></div>
                                <div class="h-3.5 w-16 bg-gray-250 dark:bg-white/15 rounded"></div>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-brand-200 dark:border-white/10">
                                <div class="h-4 w-24 bg-gray-255 dark:bg-white/15 rounded"></div>
                                <div class="h-4.5 w-20 bg-gray-255 dark:bg-white/20 rounded"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Skeleton -->
                    <div class="flex justify-end gap-3 pt-2">
                        <div class="h-9 w-20 bg-gray-200 dark:bg-white/10 rounded-lg"></div>
                        <div class="h-9 w-28 bg-gray-200 dark:bg-white/15 rounded-lg"></div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
