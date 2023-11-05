@props(['variant' => 'info', 'close' => true])

@php
    $alertClass = [
        'info' => 'bg-blue-100 text-blue-600 border border-blue-200',
        'success' => 'bg-green-100 text-green-600 border border-green-200',
        'warning' => 'bg-amber-100 text-amber-600 border border-amber-200',
        'error' => 'bg-red-100 text-red-600 border border-red-200',
    ];
@endphp

<div x-data="{ open: true }" x-cloak x-show="open" x-transition:enter="transition ease-out delay-1000 duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="pt-12 md:mx-8 -mb-8">
    <div class="w-full relative flex px-4 py-3 rounded-lg {{ $alertClass[$variant] }}" role="alert">
        <div class="flex-shrink-0 mr-4">
            @if ($variant == 'info')
                <x-fas-info-circle class="w-8 h-8" fill="currentColor" />
            @endif
            @if ($variant == 'success')
                <x-fas-check-circle class="w-8 h-8" fill="currentColor" />
            @endif
            @if ($variant == 'warning')
                <x-fas-exclamation-triangle class="w-8 h-8" fill="currentColor" />
            @endif
            @if ($variant == 'error')
                <x-fas-exclamation-circle class="w-8 h-8" fill="currentColor" />
            @endif
        </div>

        <div class="flex-1 pt-1">
            {{ $slot }}
        </div>

        @if ($close)
            <button
                class="focus:outline-none focus:shadow-outline ml-4 w-8 h-8 inline-flex p-1 rounded-full hover:bg-transparent"
                x-on:click="open = false">
                <x-fas-xmark class="w-6 h-6" />
            </button>
        @endif
    </div>

</div>
