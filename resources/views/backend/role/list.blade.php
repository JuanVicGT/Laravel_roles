<x-app-layout>

    @section('title', __('list-role'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('list-role') }}
        </h2>
    </x-slot>

    @foreach ($alerts as $alert)
        <x-alert variant="{{ $alert->type }}">
            {{ $alert->message }}
        </x-alert>
    @endforeach

    <!-- Header  -->
    <section class="pt-12">
        <div class="w-full px-6 flex justify-between justify-items-center">
            <div class="inline-flex">
                <ol class="flex h-8 overflow-hidden space-x-2 rounded-lg">
                    <li class="flex items-center">
                        <x-routenav href="{{ route('dashboard') }}">
                            <x-fas-home class="w-4 h-4" />
                            <span class="ms-1">{{ __('Dashboard') }}</span>
                        </x-routenav>
                    </li>

                    <li class="relative flex items-center">
                        <x-routenav href="{{ route('list.role') }}" wire:navigate>
                            <x-zondicon-reload class="w-4 h-4" />
                        </x-routenav>
                    </li>
                </ol>
            </div>
            <a href="{{ route('create.role') }}" class="inline">
                <x-custom-primary-button
                    class="h-8 text-white bg-green-700 dark:bg-green-700 hover:bg-green-600 dark:hover:bg-green-600 focus:bg-green-600 dark:focus:bg-green-600 active:bg-green-600 dark:active:bg-green-600">
                    <x-fas-plus class="w-4 h-4 mr-2.5" />
                    {{ __('add-new') }}
                </x-custom-primary-button>
            </a>
        </div>
    </section>

    <!-- Table -->
    <div class="h-full flex justify-between py-4">
        <div class="hidden md:flex">
            @include('backend.sidebars.list_admin_user')
        </div>

        <div class="w-full md:pr-6 md:pl-2">

        </div>
    </div>
</x-app-layout>
