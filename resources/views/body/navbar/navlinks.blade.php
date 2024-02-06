@php
    // The pages to active the navbar option
    $userRoutes = ['list.user', 'edit.user', 'create.user'];
    $roleRoutes = ['list.role', 'edit.role', 'create.role'];
    $permissionRoutes = ['list.permission', 'edit.permission', 'create.permission'];

    $adminRoutes = [...$userRoutes, ...$roleRoutes, ...$permissionRoutes];
@endphp

<!-- Direct option -->
<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>

<!-- Admin Menú -->
@if (auth()->user()->can('view_menu_admin') || auth()->user()->admin)
    <x-dropdown-nav align="left" width="48" :active="request()->routeIs($adminRoutes)">
        @include('body.navbar.menu.admin')
    </x-dropdown-nav>
@endif
