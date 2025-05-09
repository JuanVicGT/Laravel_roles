@php

    use Illuminate\Support\Facades\Cache;

    // Se procesan los menús y submenús con sus respectivas rutas para cargarlos dinamicamente
    $menu = getNavigationMenu();

    $is_admin = auth()->user()->is_admin ?? false;

    /**
     * Obtiene el menú de navegación filtrado por los permisos del usuario.
     * @param bool $ignore_cache Ignora el cache si es true
     * @return array
     */
    function getNavigationMenu($ignore_cache = false): array
    {
        $user = auth()->user();
        $is_admin = $user->is_admin;

        // Configurar si quieres activar el cache (en desarrollo lo ponemos en false)
        $cacheEnabled = false; // Cambiar a 'true' para activar el cache en producción

        // Crear una llave de cache única por usuario
        $cacheKey = 'user_' . $user->id . '_menu';

        // Si el cache está habilitado, intentamos obtenerlo
        if ($cacheEnabled && !$ignore_cache) {
            $menu = Cache::get($cacheKey);
        } else {
            $menu = null; // No usamos cache, siempre lo vamos a generar
        }

        // Si no hay cache o si no se activó el cache, generamos el menú
        if (!$menu) {
            $pages_files = glob(base_path('Modules/*/pages.json'));

            // Genera el menú filtrado según los permisos del usuario
            $menu = collect($pages_files)
                ->flatMap(function ($path) {
                    $module = json_decode(file_get_contents($path), true);
                    return $module['pages'] ?? [];
                })
                ->sortByDesc('priority')
                ->filter(function ($page) use ($user, $is_admin) {
                    return $is_admin || $user->can($page['permission'] . '.index');
                })
                ->groupBy('menu')
                ->map(function ($pages) {
                    return $pages->keyBy('permission')->toArray();
                })
                ->toArray();

            // Si el cache está habilitado, guardamos el menú en cache
            if ($cacheEnabled) {
                Cache::put($cacheKey, $menu, 600); // Cache por 10 minutos
            }
        }

        return $menu;
    }

@endphp

{{-- The navbar with `sticky` and `full-width` --}}
<x-mary-nav sticky full-width>

    <x-slot:brand>
        {{-- Drawer toggle for "main-drawer" --}}
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-mary-icon name="o-bars-3" class="cursor-pointer" />
        </label>
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions>
        <x-mary-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
        <x-mary-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />

        {{-- User --}}
        @if ($user = auth()->user())
            <!-- Theme Toggle and User Section -->
            <div class="flex items-center space-x-4">
                <x-mary-theme-toggle />
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="py-2 -my-2 inline-flex items-center px-3 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        @endif
    </x-slot:actions>
</x-mary-nav>

{{-- MAIN --}}
<x-mary-main with-nav full-width>
    {{-- SIDEBAR --}}
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

        {{-- BRAND --}}
        <div class="mary-hideable">
            <div class="pt-5 grid place-items-center w-full">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="w-24 object-contain fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <x-mary-menu-separator />
        </div>

        {{-- MENU --}}
        <x-mary-menu activate-by-route>

            {{-- User --}}
            @if ($user = auth()->user())
                <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                    class="-mx-2 !-my-2 rounded lg:hidden" link="{{ route('profile.edit') }}">
                    <x-slot:actions>
                        {{-- Logout --}}
                        <form method="POST" class="flex" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full">
                                <x-mary-menu-item icon="o-power" />
                            </button>
                        </form>
                    </x-slot:actions>
                </x-mary-list-item>
            @endif

            {{-- Custom Links --}}
            @foreach ($menu as $section => $pages)
                @if (count($pages) === 1)
                    @foreach ($pages as $page)
                        <x-mary-menu-item title="{{ __($page['title']) }}" icon="{{ $page['icon'] }}"
                            link="{{ route($page['route']) }}" no-wire-navigate />
                    @endforeach
                @endif

                @if (count($pages) > 1)
                    <x-mary-menu-sub title="{{ __($section) }}" icon="o-queue-list">
                        @foreach ($pages as $page)
                            <x-mary-menu-item title="{{ __($page['title']) }}" icon="{{ $page['icon'] }}"
                                link="{{ route($page['route']) }}" no-wire-navigate />
                        @endforeach
                    </x-mary-menu-sub>
                @endif
            @endforeach
        </x-mary-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content class="lg:px-6">

        {{-- ALERTS --}}
        @if (session('alerts'))
            @foreach (session('alerts') as $alert)
                <div class="pb-5">
                    <x-penguin-alert type="{{ $alert->type }}" title="{{ $alert->title }}"
                        message="{{ $alert->message }}" />
                </div>
            @endforeach
        @endif

        <!-- Page Heading -->
        @isset($header)
            <header class="w-full">
                {{ $header }}
            </header>
        @endisset

        <!-- Page Content -->
        {{ $slot }}

        <!-- Page Footer -->
        @isset($footer)
            <footer class="w-full">
                {{ $footer }}
            </footer>
        @endisset
    </x-slot:content>
</x-mary-main>
