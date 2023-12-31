<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('dashboard') }}
        </h2>
    </x-slot>

    @foreach ($alerts as $alert)
        <x-alert variant="{{ $alert->type }}">
            {{ $alert->message }}
        </x-alert>
    @endforeach

    <div class="pt-12 pb-4" name="content">
        <div class="max-w-screen mx-auto sm:px-6 lg:px-8 space-y-6">
            <livewire:backend.user-table />
        </div>
    </div>

</x-app-layout>
