<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('users') }}
        </h2>
    </x-slot>

    @foreach ($alerts as $alert)
        <x-alert variant="{{ $alert->type }}">
            {{ $alert->message }}
        </x-alert>
    @endforeach

    <!-- Header  -->
    <section class="pt-12">
        <div class="w-full mx-auto px-6 md:px-8 flex justify-between justify-items-center">
            <div aria-label="Breadcrumb" class="inline-flex">
                <ol class="flex overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-white">
                    <li class="flex items-center">
                        <div
                            class="flex h-10 items-center gap-1.5 bg-gray-200 dark:bg-gray-700 px-4 transition ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>

                            <span class="ms-1.5 font-medium">{{ __('user') }}</span>
                        </div>
                    </li>

                    <li class="relative flex items-center">
                        <span
                            class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-200 dark:bg-gray-700 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180">
                        </span>

                        <a wire:navigate href="{{ route('list.user') }}"
                            class="flex h-10 items-center bg-white dark:bg-gray-500 pe-4 ps-6 font-medium transition hover:bg-gray-200 dark:hover:bg-gray-700">
                            {{ __('list') }}
                        </a>
                    </li>
                </ol>
            </div>
            <a wire:navigate href="{{ route('create.user') }}" class="inline">
                <x-primary-button class="bg-green-700 dark:bg-green-700 hover:bg-green-600 dark:hover:bg-green-600 focus:bg-green-600 dark:focus:bg-green-600 active:bg-green-600 dark:active:bg-green-600 h-10">
                    <x-fas-plus class="w-4 h-4 mr-2.5" />
                    {{ __('add-new') }}
                </x-primary-button>
            </a>
        </div>
    </section>

    <section class="py-4">
        <div class="max-w-screen mx-auto sm:px-6 lg:px-8 space-y-6">
            <livewire:backend.user-table />
        </div>
    </section>
</x-app-layout>
