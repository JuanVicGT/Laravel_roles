<!-- Direct option -->
<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>

<!-- Admin Menú -->
@if (auth()->user()->can('view_menu_admin') || auth()->user()->admin)
    <x-dropdown-nav align="left" width="48" :active="request()->routeIs('profidle.edit', 'sapo', 'profile.edit')">
        @include('body.navbar.menu.admin')
    </x-dropdown-nav>
@endif
