<x-app-layout>

    @section('tab-title', __('Users Management'))

    <div x-data="{ selectedTab: 'users' }">

        <!-- Encabezado según tab activo -->
        <header class="w-full">
            <div x-show="selectedTab === 'users'">
                <x-cmary-header id="users" title="{{ __('Users') }}" class="mb-5" link="{{ route('user.create') }}"
                    import_link="{{ route('user.import') }}">

                    <x-mary-button icon="o-plus" label="{{ __('Import Users') }}"
                        class="text-white btn-primary dark:btn-info"
                        @click="$dispatch('open-modal', 'user_importModal')" />

                </x-cmary-header>
            </div>

            <div x-cloak x-show="selectedTab === 'roles'">
                <x-mary-header title="{{ __('Roles') }}" class="mb-5">
                    <x-slot:actions>
                        <x-mary-button icon="o-plus" label="{{ __('Create Role') }}" class="btn-success"
                            link="{{ route('user.create') }}" />
                    </x-slot:actions>
                </x-mary-header>
            </div>

            <div x-cloak x-show="selectedTab === 'permissions'">
                <x-mary-header title="{{ __('Permissions') }}" class="mb-5">
                    <x-slot:actions>
                        <x-mary-button icon="o-plus" label="{{ __('Create Permission') }}" class="btn-success"
                            link="{{ route('user.create') }}" />
                    </x-slot:actions>
                </x-mary-header>
            </div>
        </header>

        <x-card class="px-4 py-6">

            <div class="w-full">
                <div x-on:keydown.right.prevent="$focus.wrap().next()"
                    x-on:keydown.left.prevent="$focus.wrap().previous()"
                    class="flex gap-2 overflow-x-auto border-b border-outline dark:border-outline-dark" role="tablist"
                    aria-label="tab options">
                    <button x-on:click="selectedTab = 'users'" x-bind:aria-selected="selectedTab === 'users'"
                        x-bind:tabindex="selectedTab === 'users' ? '0' : '-1'"
                        x-bind:class="selectedTab === 'users' ?
                            'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                            'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                        class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                        aria-controls="tabpanelUsers">
                        <i class="fa-solid fa-user-group"></i>
                        {{ __('Users') }}
                    </button>
                    <button x-on:click="selectedTab = 'roles'" x-bind:aria-selected="selectedTab === 'roles'"
                        x-bind:tabindex="selectedTab === 'roles' ? '0' : '-1'"
                        x-bind:class="selectedTab === 'roles' ?
                            'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                            'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                        class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                        aria-controls="tabpanelRoles">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" class="size-4">
                            <path
                                d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z" />
                        </svg>
                        {{ __('Roles') }}
                    </button>
                    <button x-on:click="selectedTab = 'permissions'"
                        x-bind:aria-selected="selectedTab === 'permissions'"
                        x-bind:tabindex="selectedTab === 'permissions' ? '0' : '-1'"
                        x-bind:class="selectedTab === 'permissions' ?
                            'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                            'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                        class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                        aria-controls="tabpanelPermissions">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" class="size-4">
                            <path
                                d="M3.505 2.365A41.369 41.369 0 0 1 9 2c1.863 0 3.697.124 5.495.365 1.247.167 2.18 1.108 2.435 2.268a4.45 4.45 0 0 0-.577-.069 43.141 43.141 0 0 0-4.706 0C9.229 4.696 7.5 6.727 7.5 8.998v2.24c0 1.413.67 2.735 1.76 3.562l-2.98 2.98A.75.75 0 0 1 5 17.25v-3.443c-.501-.048-1-.106-1.495-.172C2.033 13.438 1 12.162 1 10.72V5.28c0-1.441 1.033-2.717 2.505-2.914Z" />
                            <path
                                d="M14 6c-.762 0-1.52.02-2.271.062C10.157 6.148 9 7.472 9 8.998v2.24c0 1.519 1.147 2.839 2.71 2.935.214.013.428.024.642.034.2.009.385.09.518.224l2.35 2.35a.75.75 0 0 0 1.28-.531v-2.07c1.453-.195 2.5-1.463 2.5-2.915V8.998c0-1.526-1.157-2.85-2.729-2.936A41.645 41.645 0 0 0 14 6Z" />
                        </svg>
                        {{ __('Permissions') }}
                    </button>
                </div>
                <div class="px-2 py-4 text-on-surface dark:text-on-surface-dark">
                    <!-- User tabs -->
                    <div x-cloak x-show="selectedTab === 'users'" id="tabpanelUsers" role="tabpanel" aria-label="users">
                        <livewire:core.livewire.user-table />
                    </div>
                    <!-- Role tabs -->
                    <div x-cloak x-show="selectedTab === 'roles'" id="tabpanelRoles" role="tabpanel" aria-label="roles">
                        <b><a href="#" class="underline">Roles</a></b> tab is selected
                    </div>
                    <!-- Permission tabs -->
                    <div x-cloak x-show="selectedTab === 'permissions'" id="tabpanelPermissions" role="tabpanel"
                        aria-label="permissions"><b><a href="#" class="underline">Permissions</a></b> tab is
                        selected
                    </div>
                </div>
            </div>

        </x-card>
    </div>

</x-app-layout>

<x-penguin-modal id="myModal" title="Oferta Especial">
    <form class="grid grid-cols-1 gap-4 sm:grid-cols-3" action="{{ route('user.create') }}" method="GET">
        <div class="col-span-1">
            <x-mary-input label="Nombre" name="name" />
        </div>
        <div class="col-span-1">
            <x-mary-input label="Apellido" name="last_name" />
        </div>
        <div class="col-span-1">
            <x-mary-input label="Email" name="email" type="email" />
        </div>
        <div class="col-span-2">
            <x-mary-input label="Direccion" name="address" />
        </div>
        <div class="col-span-1">
            <x-mary-input label="Telefono" name="phone" type="tel" />
        </div>
        <div class="col-span-1">
            <x-mary-input label="Edad" name="age" type="number" />
        </div>

        <x-mary-button label="{{ __('Show Modal') }}" class="btn-success mt-4" type="submit" />
    </form>
</x-penguin-modal>

<x-penguin-modal id="user_importModal" title="{{ __('Import User') }}">
    <form class="grid grid-cols-1 gap-4 sm:grid-cols-3 w-[650px]" action="{{ route('user.import') }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="col-span-3">
            <x-penguin-input-file name="file" title="{{ __('Select File') }}" accept="{{ 'text/csv' }}"
                accept_titles="{{ 'CSV' }}" />

            <input type="file" name="csvFile" class="border p-2 w-full">
        </div>

        <div class="col-span-3 flex justify-between mt-6">
            <x-mary-button class="btn-neutral"
                @click="$dispatch('close-modal', 'user_importModal')">{{ __('Cancel') }}</x-mary-button>

            <x-mary-button class="btn-warning" type="submit">{{ __('Submit') }}</x-mary-button>
        </div>
    </form>
</x-penguin-modal>
