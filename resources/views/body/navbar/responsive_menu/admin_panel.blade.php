<section class="border-t border-gray-200 dark:border-gray-600">
    <div class="text-lg font-medium text-gray-600 dark:text-gray-400">
        <h3 class="text-center py-2">{{ __('users-section') }}</h3>
    </div>

    <x-responsive-nav-link :href="route('list.user')" :active="request()->routeIs('list.user')">
        {{ __('users') }}
    </x-responsive-nav-link>

    <x-responsive-nav-link :href="route('list.role')" :active="request()->routeIs('list.role')">
        {{ __('roles') }}
    </x-responsive-nav-link>

    <x-responsive-nav-link :href="route('list.permission')" :active="request()->routeIs('list.permission')">
        {{ __('permissions') }}
    </x-responsive-nav-link>
</section>
