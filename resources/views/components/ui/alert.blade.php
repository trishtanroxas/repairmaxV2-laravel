@props(['type' => 'info', 'dismissible' => true])

@php
$typeClasses = match ($type) {
'success' => 'bg-green-50 text-green-800 border-green-200',
'error' => 'bg-red-50 text-red-800 border-red-200',
'warning' => 'bg-yellow-50 text-yellow-800 border-yellow-200',
default => 'bg-gray-50 text-gray-800 border-gray-200',
};

$icon = match ($type) {
'success' => 'check_circle',
'error' => 'error',
'warning' => 'warning',
default => 'info',
};
@endphp

<div x-data="{ show: true }" x-show="show"
    class="flex items-start p-4 border rounded-xl {{ $typeClasses }} transition-all"
    x-transition.opacity>
    <span class="material-symbols-outlined shrink-0 mr-3">{{ $icon }}</span>
    <div class="flex-1 text-sm font-medium">
        {{ $slot }}
    </div>
    @if($dismissible)
    <button @click="show = false" class="ml-3 shrink-0 opacity-50 hover:opacity-100 transition-opacity">
        <span class="material-symbols-outlined text-xl">close</span>
    </button>
    @endif
</div>