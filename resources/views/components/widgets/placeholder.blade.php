@props(['title'])

<div class="bg-white dark:bg-[#1E1E1C] border border-gray-200 dark:border-[#2A2A28] rounded-xl p-5 shadow-sm">
    <h3 class="text-[14px] font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wide border-b border-gray-100 dark:border-[#2A2A28] pb-2">{{ $title }}</h3>
    <div class="animate-pulse flex space-x-4">
        <div class="flex-1 space-y-3 py-1">
            <div class="h-2 bg-gray-200 dark:bg-[#333] rounded"></div>
            <div class="space-y-2">
                <div class="grid grid-cols-3 gap-4">
                    <div class="h-2 bg-gray-200 dark:bg-[#333] rounded col-span-2"></div>
                    <div class="h-2 bg-gray-200 dark:bg-[#333] rounded col-span-1"></div>
                </div>
                <div class="h-2 bg-gray-200 dark:bg-[#333] rounded"></div>
            </div>
        </div>
    </div>
</div>
