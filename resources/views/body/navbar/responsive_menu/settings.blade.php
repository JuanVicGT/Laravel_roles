<section class="border-t border-gray-200 dark:border-gray-600">
    <div class="text-lg font-medium text-gray-600 dark:text-gray-400">
        <h3 class="text-center py-2">{{ Auth::user()->name }}</h3>
    </div>

    <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-responsive-nav-link>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</section>
