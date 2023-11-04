<section class="border-t border-gray-200 dark:border-gray-600">
    <div class="text-lg font-medium text-gray-600 dark:text-gray-400">
        <h3 class="text-center py-2">{{ __('title') }}</h3>
    </div>

    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
        {{ __('DEMO MENU') }}
    </x-responsive-nav-link>
</section>
