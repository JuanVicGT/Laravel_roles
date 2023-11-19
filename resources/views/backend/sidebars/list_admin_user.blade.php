<aside class="w-56 px-4 transition-transform" aria-label="Sidebar">
    <div class="h-full overflow-y-auto ">
        <ul class="space-y-2 font-medium">
            <li>
                <x-sidenav-link :active="request()->routeIs('list.user')" :href="route('list.user')" wire:navigate>
                    <x-fas-users class="w-5 h-5" />
                    <span class="ms-3">{{ __('users') }}</span>
                </x-sidenav-link>
            </li>
            <li>
                <x-sidenav-link :active="request()->routeIs('list.role')" :href="route('list.role')" wire:navigate>
                    <x-fas-users class="w-5 h-5" />
                    <span class="ms-3">{{ __('roles') }}</span>
                </x-sidenav-link>
            </li>
            <li>
                <x-sidenav-link :active="request()->routeIs('list.permission')" :href="route('list.permission')" wire:navigate>
                    <x-fas-users class="w-5 h-5" />
                    <span class="ms-3">{{ __('permissions') }}</span>
                </x-sidenav-link>
            </li>
    </div>
</aside>
