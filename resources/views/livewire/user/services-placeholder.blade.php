<div class="w-full">
    <div class="mb-8 animate-pulse">
        <div class="h-8 w-60 bg-gray-200 dark:bg-white/15 rounded-xl"></div>
        <div class="h-4 w-96 bg-gray-200 dark:bg-white/10 rounded-lg mt-2"></div>
    </div>

    <!-- Search & Filters Skeleton -->
    <div class="bg-white dark:bg-white/3 border border-gray-200/80 dark:border-white/10 p-6 mb-8 space-y-6 animate-pulse" style="border-radius: 2rem;">
        <div class="relative w-full max-w-xl mx-auto">
            <div class="w-full h-12 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl"></div>
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap items-center justify-center gap-2">
            @for ($i = 0; $i < 6; $i++)
                <div class="h-8 w-24 bg-gray-100 dark:bg-white/5 border border-gray-250 dark:border-white/5 rounded-xl"></div>
            @endfor
        </div>
    </div>

    <!-- Services Grid Skeleton -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @for ($i = 0; $i < 6; $i++)
            <div class="animate-pulse bg-white dark:bg-white/3 border border-gray-200/80 dark:border-white/10 p-0 flex flex-col overflow-hidden shadow-lg" style="border-radius: 2rem;">
                <div class="h-44 bg-gray-200 dark:bg-white/10 w-full shrink-0"></div>
                <div class="p-6 flex flex-col flex-1 space-y-4">
                    <div class="h-5 w-24 bg-gray-200 dark:bg-white/10 rounded-full"></div>
                    <div class="h-6 w-3/4 bg-gray-250 dark:bg-white/15 rounded-xl"></div>
                    <div class="space-y-2">
                        <div class="h-3 bg-gray-200 dark:bg-white/10 rounded w-full"></div>
                        <div class="h-3 bg-gray-200 dark:bg-white/10 rounded w-5/6"></div>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200/60 dark:border-white/5 mt-auto">
                        <div class="space-y-1">
                            <div class="h-2 w-16 bg-gray-200 dark:bg-white/10 rounded"></div>
                            <div class="h-5 w-24 bg-gray-250 dark:bg-white/15 rounded"></div>
                        </div>
                        <div class="h-9 w-16 bg-gray-200 dark:bg-white/10 rounded-xl"></div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
