<x-slot name="trigger">
    <button class="flex h-full items-center transition duration-150 ease-in-out">
        <div>Admin</div>

        <div class="ml-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </button>
</x-slot>

<x-slot name="content">
    {{--     
    <!-- Admin settings -->
    <x-multiple-dropdown-nav :active="request()->routeIs('profile.edit')">
        @include('body.navbar.submenu.admin_user')
    </x-multiple-dropdown-nav> 
    --}}

    <x-dropdown-link :href="route('list.user')" :active="request()->routeIs('list.user')">
        <div class="flex items-center">
            <x-fas-users class="w-6 h-6 mr-2" />
            <div class="flex items-center w-full justify-between">
                <p class="text-base">{{ __('users') }}</p>
            </div>
        </div>
    </x-dropdown-link>
</x-slot>
