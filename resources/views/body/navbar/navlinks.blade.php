<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>

<x-dropdown-nav align="left" width="48" :active="request()->routeIs('profidle.edit', 'sapo', 'profile.edit')" >
    @include('body.navbar.menu.demo')
</x-dropdown-nav>
