<x-app-layout>

    @section('title', __('list-permission'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('list-permission') }}
        </h2>
    </x-slot>

    @foreach ($alerts as $alert)
        <x-alert variant="{{ $alert->type }}">
            {{ $alert->message }}
        </x-alert>
    @endforeach

    <!-- Header  -->
    <section class="pt-12">
        <div class="w-full px-4 flex justify-between justify-items-center">
            <div class="inline-flex">
                <ol class="flex h-8 overflow-hidden space-x-2 rounded-lg">
                    <li class="flex items-center">
                        <x-routenav href="{{ route('dashboard') }}">
                            <x-fas-home class="w-4 h-4" />
                            <span class="ms-1">{{ __('Dashboard') }}</span>
                        </x-routenav>
                    </li>

                    <li class="relative flex items-center">
                        <x-routenav href="{{ route('list.permission') }}" wire:navigate>
                            <x-zondicon-reload class="w-4 h-4" />
                        </x-routenav>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Table -->
    <div class="h-full flex justify-between py-4">
        <div class="hidden md:flex">
            @include('backend.sidebars.list_admin_user')
        </div>

        <div class="w-full md:pr-6 md:pl-2">
            <livewire:backend.permission_table />
        </div>
    </div>
</x-app-layout>
