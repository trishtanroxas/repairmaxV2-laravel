@props(['name', 'title', 'message'])

<x-ui.modal :name="$name" maxWidth="md">
    <div class="p-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="bg-red-100 text-red-600 p-3 rounded-full flex shrink-0">
                <span class="material-symbols-outlined">warning</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900">{{ $title }}</h3>
        </div>

        <p class="text-gray-600 mb-8 ml-16">{{ $message }}</p>

        <div class="flex justify-end gap-3">
            <button x-data @click="$dispatch('close-modal', '{{ $name }}')" class="px-5 py-2.5 text-gray-600 font-medium hover:bg-gray-50 rounded-xl transition-all">
                Cancel
            </button>
            {{ $slot }}
        </div>
    </div>
</x-ui.modal>