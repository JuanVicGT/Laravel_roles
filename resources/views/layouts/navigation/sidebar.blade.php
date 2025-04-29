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

{{-- Theme toggle --}}
<x-mary-theme-toggle class="hidden" />

{{-- NAVBAR mobile only --}}
<x-mary-nav sticky class="lg:hidden">
    <x-slot:brand>
        <div class="ml-5 pt-5">
            <span class="text-center mt-2">{{ config('app.layout_name', __('New Instance')) }}</span>
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
                <span class="text-center mt-2">{{ config('app.layout_name') }}</span>
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
                    <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                        class="-mx-2 !-my-2 rounded" link="{{ route('profile.edit') }}">
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

                                {{-- Theme Toggle Button --}}
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

            {{-- Custom Links --}}
            @foreach ($menu as $section => $pages)
                @if (count($pages) === 1)
                    @foreach ($pages as $page)
                        <x-mary-menu-item title="{{ __($page['title']) }}" icon="{{ $page['icon'] }}"
                            link="{{ route($page['route']) }}" />
                    @endforeach
                @endif

                @if (count($pages) > 1)
                    <x-mary-menu-sub title="{{ __($section) }}" icon="o-queue-list">
                        @foreach ($pages as $page)
                            <x-mary-menu-item title="{{ __($page['title']) }}" icon="{{ $page['icon'] }}"
                                link="{{ route($page['route']) }}" />
                        @endforeach
                    </x-mary-menu-sub>
                @endif
            @endforeach
        </x-mary-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content>
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

{{-- Toast --}}
<x-mary-toast />
