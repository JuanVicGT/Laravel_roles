<x-app-layout path="layouts.app">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Movements') }}
        </h2>
    </x-slot>

    {{-- Notifications, remember initialize Alpine for notifications --}}
    @livewire('modules.simple-financial-management.movement-crud')

</x-app-layout>
