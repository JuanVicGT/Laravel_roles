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

        {{-- Theme Switcher --}}
        <x-mary-theme-toggle />

        {{-- Language Switcher --}}
        <div class="flex items-center space-x-2">
            <x-mary-dropdown right label="{{ __('Language') }}">
                <x-mary-menu-item @click.stop="$event.target.closest('form').submit()">
                    <!-- primary Button with Icon -->
                    <form method="POST" action="{{ route('profile.language.switch') }}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/es-gt.svg') }}"
                                class="w-8 h-8 mr-2 rounded-full object-cover" alt="Guatemala" />
                            <span class="hidden lg:block">{{ __('Spanish') }}</span>
                            <input type="hidden" name="locale" value="es">
                        </div>
                    </form>
                </x-mary-menu-item>

                <x-mary-menu-item @click.stop="$event.target.closest('form').submit()">
                    <!-- primary Button with Icon -->
                    <form method="POST" action="{{ route('profile.language.switch') }}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/en-us.svg') }}"
                                class="w-8 h-8 mr-2 rounded-full object-cover" alt="Estados Unidos" />
                            <span class="hidden lg:block">{{ __('English') }}</span>
                            <input type="hidden" name="locale" value="en">
                        </div>
                    </form>
                </x-mary-menu-item>
            </x-mary-dropdown>
        </div>

        {{-- 
        <x-mary-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
        <x-mary-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive /> 
        --}}

        {{-- User --}}
        @if ($user = auth()->user())
            <!-- Theme Toggle and User Section -->
            <div class="flex items-center space-x-4">

                <div class="hidden sm:flex sm:items-center">
                    {{-- User Dropdown --}}
                    <x-mary-dropdown label="{{ $user->name }}">
                        {{-- Edit Profile --}}
                        <x-mary-menu-item title="{{ __('Edit Profile') }}" icon="o-user"
                            link="{{ route('profile.edit') }}" />

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-mary-menu-item title="{{ __('Log Out') }}" icon="s-power"
                                onclick="event.preventDefault(); this.closest('form').submit();" />
                        </form>
                    </x-mary-dropdown>
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
