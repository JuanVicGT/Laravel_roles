<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-responsive-nav-link>

<x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
    {{ __('DEMO MENU') }}
</x-responsive-nav-link>