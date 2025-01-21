    {{-- NAVBAR mobile only --}}
    <x-mary-nav sticky class="lg:hidden">
        <x-slot:brand>
            <div class="ml-5 pt-5">
                <span class="text-center mt-2">{{ config('app.name', __('New Instance')) }}</span>
            </div>
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-mary-nav>

    {{-- MAIN --}}
    <x-mary-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <div class="mary-hideable">
                <div class="pt-5 grid place-items-center w-full">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="w-24 object-contain fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                    <span class="text-center mt-2">{{ config('app.name', __('New Instance')) }}</span>
                </div>
            </div>

            {{-- BRAND WHEN COLLAPSED --}}
            <div class="display-when-collapsed">
                <div class="pt-5 grid place-items-center w-full">
                    <a href="{{ route('dashboard') }}">
                        <x-mary-icon name="o-home" class="w-6" />
                    </a>
                </div>
            </div>

            {{-- MENU --}}
            <x-mary-menu activate-by-route>

                {{-- User --}}
                @if ($user = auth()->user())
                    <x-mary-menu-separator />

                    <div class="display-when-collapsed">
                        <div class="grid place-items-center w-full">
                            <a href="{{ route('profile.edit') }}">
                                <x-mary-icon name="o-user" class="w-6" />
                            </a>
                        </div>
                    </div>

                    {{-- Avatar, Name and Work_position --}}
                    <div class="mary-hideable">
                        <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator
                            no-hover class="-mx-2 !-my-2 rounded" link="{{ route('profile.edit') }}">
                            <x-slot:avatar>
                                @if ($user->avatar)
                                    <x-mary-avatar image="{{ asset('storage/' . $user->avatar) }}" class="!w-10" />
                                @else
                                    <x-mary-icon name="o-user" class="!w-6" />
                                @endif
                            </x-slot:avatar>

                            {{-- Actions --}}
                            <x-slot:actions>
                                <x-mary-dropdown>
                                    <x-slot:trigger no-separator no-hover class="!-my-2 rounded">
                                        <x-mary-button icon="o-cog-6-tooth" class="btn-circle" />
                                    </x-slot:trigger>

                                    <x-mary-menu-item title="{{ __('Profile') }}" icon="o-user"
                                        link="{{ route('profile.edit') }}" no-wire-navigate />
                                    <x-mary-menu-item title="{{ __('Change Theme') }}" icon="o-swatch" @click.stop=""
                                        @click="$dispatch('mary-toggle-theme')" />

                                    <x-mary-menu-separator />

                                    {{-- Logout --}}
                                    <form method="POST" action="{{ route('logout') }}" class="flex">
                                        @csrf
                                        <button type="submit" class="w-full">
                                            <x-mary-menu-item title="{{ __('Logout') }}" icon="o-power" />
                                        </button>
                                    </form>
                                </x-mary-dropdown>
                            </x-slot:actions>
                        </x-mary-list-item>
                    </div>

                    <x-mary-menu-separator />
                @endif

                <x-mary-menu-item title="Hello" icon="o-sparkles" link="/" />
                <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-mary-menu-item title="Wifi" icon="o-wifi" link="{{ route('dashboard') }}" />
                    <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-mary-menu-sub>
            </x-mary-menu>
        </x-slot:sidebar>

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
