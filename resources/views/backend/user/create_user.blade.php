<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('new-user') }}
        </h2>
    </x-slot>

    @foreach ($alerts as $alert)
        <x-alert variant="{{ $alert->type }}">
            {{ $alert->message }}
        </x-alert>
    @endforeach

    <!-- Header  -->
    <section class="pt-8">
        <div x-cloak x-data="{ sidebarOpen: true }" class="relative flex items-start ">
            <div wire:ignore :class="{ 'w-56': sidebarOpen, 'w-0': !sidebarOpen }"
                class="fixed w-56 h-full overflow-y-auto text-gray-400 transition-all duration-300 ease-in-out bg-gray-900 shadow-lg overflow-x-hidden">

                <div class="flex flex-col items-stretch justify-between h-full">
                    <div class="flex flex-col flex-shrink-0 w-full">
                        <div class="flex items-center justify-center px-8 py-3 text-center">
                            <a href="#"
                                class="text-lg leading-normal text-gray-200 focus:outline-none focus:ring">My
                                App</a>
                        </div>

                        <nav>
                            <div class="flex-grow md:block md:overflow-y-auto overflow-x-hidden"
                                :class="{ 'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen }">
                                <a class="flex justify-start items-center px-4 py-3 hover:bg-gray-800 hover:text-gray-400 focus:bg-gray-800 focus:outline-none focus:ring"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        aria-hidden="true" role="img" class="w-5 h-5 fill-current"
                                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 1200 1200">
                                        <path
                                            d="M600 195.373c-331.371 0-600 268.629-600 600c0 73.594 13.256 144.104 37.5 209.253h164.062C168.665 942.111 150 870.923 150 795.373c0-248.528 201.471-450 450-450s450 201.472 450 450c0 75.55-18.665 146.738-51.562 209.253H1162.5c24.244-65.148 37.5-135.659 37.5-209.253c0-331.371-268.629-600-600-600zm0 235.62c-41.421 0-75 33.579-75 75c0 41.422 33.579 75 75 75s75-33.578 75-75c0-41.421-33.579-75-75-75zm-224.927 73.462c-41.421 0-75 33.579-75 75c0 41.422 33.579 75 75 75s75-33.578 75-75c0-41.421-33.579-75-75-75zm449.854 0c-41.422 0-75 33.579-75 75c0 41.422 33.578 75 75 75c41.421 0 75-33.578 75-75c0-41.421-33.579-75-75-75zM600 651.672l-58.813 294.141v58.814h117.627v-58.814L600 651.672z"
                                            fill="currentColor"></path>
                                    </svg>
                                    <span class="mx-4">Dashboard</span>
                                </a>

                                <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring {{ request()->is('dashboard/orders*') ? 'bg-gray-800' : '' }}"
                                    href="{{ route('list.user') }}">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        data-name="Layer 1" viewBox="0 0 24 24">
                                        <path
                                            d="M14,18a1,1,0,0,0,1-1V15a1,1,0,0,0-2,0v2A1,1,0,0,0,14,18Zm-4,0a1,1,0,0,0,1-1V15a1,1,0,0,0-2,0v2A1,1,0,0,0,10,18ZM19,6H17.62L15.89,2.55a1,1,0,1,0-1.78.9L15.38,6H8.62L9.89,3.45a1,1,0,0,0-1.78-.9L6.38,6H5a3,3,0,0,0-.92,5.84l.74,7.46a3,3,0,0,0,3,2.7h8.38a3,3,0,0,0,3-2.7l.74-7.46A3,3,0,0,0,19,6ZM17.19,19.1a1,1,0,0,1-1,.9H7.81a1,1,0,0,1-1-.9L6.1,12H17.9ZM19,10H5A1,1,0,0,1,5,8H19a1,1,0,0,1,0,2Z" />
                                    </svg>
                                    <span class="mx-4">Orders</span>
                                </a>

                                <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring"
                                    href="#">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        data-name="Layer 1" viewBox="0 0 24 24">
                                        <path
                                            d="M9,10h1a1,1,0,0,0,0-2H9a1,1,0,0,0,0,2Zm0,2a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2ZM20,8.94a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.32.32,0,0,0-.09,0A.88.88,0,0,0,13.05,2H7A3,3,0,0,0,4,5V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V9S20,9,20,8.94ZM14,5.41,16.59,8H15a1,1,0,0,1-1-1ZM18,19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V5A1,1,0,0,1,7,4h5V7a3,3,0,0,0,3,3h3Zm-3-3H9a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2Z" />
                                    </svg>
                                    <span class="mx-4">Pages</span>

                                </a>

                            </div>
                        </nav>
                    </div>>
                </div>
            </div>

            <div class="flex-col w-full h-full bg-red-500 transition-all duration-300 md:flex md:flex-col">
                <div class="fixed transition-all duration-300" :class="{ 'left-56': sidebarOpen, 'left-0': !sidebarOpen }">
                    <div class="flex justify-end">
                        <button @click="sidebarOpen = !sidebarOpen"
                            :class="{ 'hover:bg-gray-300': !sidebarOpen, 'hover:bg-gray-700': sidebarOpen }"
                            class="transition-all duration-300 w-8 p-1 mx-3 my-2 rounded-full focus:outline-none">
                            <svg viewBox="0 0 20 20" class="w-6 h-6 fill-current"
                                :class="{ 'text-gray-600': !sidebarOpen, 'text-gray-300': sidebarOpen }">
                                <path x-show="!sidebarOpen" fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path x-show="sidebarOpen" fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </section>
</x-app-layout>
