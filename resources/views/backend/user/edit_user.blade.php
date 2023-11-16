<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('user') }}
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
                <ol
                    class="flex overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-white">
                    <li class="flex items-center">
                        <div class="flex h-10 items-center gap-1.5 bg-gray-200 dark:bg-gray-700 px-4 transition ">
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
                <x-primary-button
                    class="bg-green-700 dark:bg-green-700 hover:bg-green-600 dark:hover:bg-green-600 focus:bg-green-600 dark:focus:bg-green-600 active:bg-green-600 dark:active:bg-green-600 h-10">
                    <x-fas-plus class="w-4 h-4 mr-2.5" />
                    {{ __('add-new') }}
                </x-primary-button>
            </a>
        </div>
    </section>

    <!-- Table -->
    <section class="pb-12 pt-2 h-full max-h-full">
        <div class="invisible md:visible">
            <aside id="separator-sidebar" class="fixed w-56 z-40 left-2 transition-transform" aria-label="Sidebar">
                <div class="h-full py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 22 21">
                                    <path
                                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                    <path
                                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                </svg>
                                <span class="ms-3">Dashboard</span>
                            </a>
                        </li>
                        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 17 20">
                                        <path
                                            d="M7.958 19.393a7.7 7.7 0 0 1-6.715-3.439c-2.868-4.832 0-9.376.944-10.654l.091-.122a3.286 3.286 0 0 0 .765-3.288A1 1 0 0 1 4.6.8c.133.1.313.212.525.347A10.451 10.451 0 0 1 10.6 9.3c.5-1.06.772-2.213.8-3.385a1 1 0 0 1 1.592-.758c1.636 1.205 4.638 6.081 2.019 10.441a8.177 8.177 0 0 1-7.053 3.795Z" />
                                    </svg>
                                    <span class="ms-3">Upgrade to Pro</span>
                                </a>
                            </li>
                        </ul>
                </div>
            </aside>
        </div>


        <div class="fixed px-8 md:left-56 md:w-[calc(100%-14rem)] space-y-56">
            <livewire:backend.user-table />
        </div>
    </section>
</x-app-layout>
