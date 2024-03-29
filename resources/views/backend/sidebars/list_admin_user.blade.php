<aside class="w-56 px-4 transition-transform" aria-label="Sidebar">
    <div class="h-full overflow-y-auto ">
        <ul class="space-y-2 font-medium">
            <li>
                <x-sidenav-link :active="request()->routeIs('list.user')" :href="route('list.user')">
                    <x-fas-users class="w-5 h-5" />
                    <span class="ms-3">{{ __('users') }}</span>
                </x-sidenav-link>
            </li>
            @if (auth()->user()->hasPermissionTo('list_role') || auth()->user()->admin)
                <li>
                    <x-sidenav-link :active="request()->routeIs('list.role')" :href="route('list.role')">
                        <x-fas-users class="w-5 h-5" />
                        <span class="ms-3">{{ __('roles') }}</span>
                    </x-sidenav-link>
                </li>
            @endif
            @if (auth()->user()->hasPermissionTo('list_permission') || auth()->user()->admin)
                <li>
                    <x-sidenav-link :active="request()->routeIs('list.permission')" :href="route('list.permission')">
                        <x-fas-users class="w-5 h-5" />
                        <span class="ms-3">{{ __('permissions') }}</span>
                    </x-sidenav-link>
                </li>
            @endif
    </div>
</aside>
