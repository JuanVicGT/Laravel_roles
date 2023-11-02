<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>

<x-nav-dropdown align="left" width="48" :active="request()->routeIs('profidle.edit', 'sapo', 'profile.edit')" >
    @include('body.navbar.menu.demo')
</x-nav-dropdown>
