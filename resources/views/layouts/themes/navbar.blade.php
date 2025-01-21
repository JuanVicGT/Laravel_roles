<div x-data="{ mobileMenuIsOpen: false }" class="sticky top-0 z-10 bg-base-100 dark:bg-gray-900 gap-4 px-8">
    <div class=" navbar w-full">
        <div class="flex-none">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>
        <div class="flex-1 pl-4">
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <!-- Add more navigation links here -->
            </div>
        </div>

        <div class="flex-none">
            <!-- Theme Toggle and User Section -->
            <div class="flex items-center space-x-4">
                <x-mary-theme-toggle />
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>

        <!-- Mobile version -->
        <div class="sm:hidden">
            <button @click="mobileMenuIsOpen = ! mobileMenuIsOpen"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': mobileMenuIsOpen, 'inline-flex': !mobileMenuIsOpen }" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !mobileMenuIsOpen, 'inline-flex': mobileMenuIsOpen }" class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <ul x-cloak x-show="mobileMenuIsOpen"
        x-transition:enter="transition motion-reduce:transition-none ease-out duration-300"
        x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition motion-reduce:transition-none ease-out duration-300"
        x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full"
        class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col rounded-b-xl border-b border-slate-300 bg-slate-100 px-8 pb-6 pt-8 dark:border-slate-700 dark:bg-slate-800 sm:hidden">

        <li class="mb-2 border-none">
            {{-- User and close button for mobile --}}
            @if ($user = auth()->user())
                <div class="flex items-center justify-between py-2 gap-4">
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <div class="flex items-center gap-2">
                            <!-- Avatar -->
                            @if ($user->avatar)
                                <x-mary-avatar image="{{ asset('storage/' . $user->avatar) }}" class="!w-8" />
                            @else
                                <x-mary-icon name="o-user" class="!w-8" />
                            @endif
                            <div>
                                <span class="font-medium text-black dark:text-white">{{ $user->name }}</span>
                                <p class="text-sm text-slate-700 dark:text-slate-300">{{ $user->email }}</p>
                            </div>
                        </div>
                    </x-responsive-nav-link>

                    <button @click="mobileMenuIsOpen = false"
                        class="ml-auto text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            @else
                <!-- Close button for mobile -->
                <div class="flex items-right py-2">
                    <button @click="mobileMenuIsOpen = false"
                        class="ml-auto text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            @endif
        </li>

        <x-mary-menu-separator />

        <li class="mb-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <x-mary-icon name="o-home" class="mr-2" />
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </li>

        <x-mary-menu-separator />

        <!-- CTA Button -->
        <li class="mt-4 w-full border-none">
            <a href="{{ route('logout') }}"
                class="rounded-xl bg-red-700 px-4 py-2 block text-center font-medium tracking-wide text-slate-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700 active:opacity-100 active:outline-offset-0 dark:bg-red-600 dark:text-slate-100 dark:focus-visible:outline-red-600">{{ __('Logout') }}
            </a>
        </li>
    </ul>
</div>

{{-- MAIN --}}
<x-mary-main full-width>

    {{-- ALERTS --}}
    @if (session('alerts'))
        @foreach (session('alerts') as $alert)
            <x-penguin-alert type="{{ $alert['type'] ?? 'info' }}" title="{{ $alert['title'] ?? '' }}"
                message="{{ $alert['message'] }}" class="mb-4" />
        @endforeach
    @endif

    {{-- The `$slot` goes here --}}
    <x-slot:content>
        {{ $slot }}
    </x-slot:content>
</x-mary-main>

{{-- Toast --}}
<x-mary-toast />
