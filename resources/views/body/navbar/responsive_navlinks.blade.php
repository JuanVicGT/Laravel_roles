<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-responsive-nav-link>

<div class="border-t border-gray-200 dark:border-gray-600">
    <h3 class="text-center py-2">{{ __('title') }}</h3>
</div>

<x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
    {{ __('DEMO MENU') }}
</x-responsive-nav-link>
