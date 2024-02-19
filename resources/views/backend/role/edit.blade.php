<x-app-layout>

    @section('title', __('edit-role'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('user') }}
        </h2>
    </x-slot>

    @foreach ($alerts as $alert)
        <x-alert variant="{{ $alert->type }}">
            {{ $alert->message }}
        </x-alert>
    @endforeach

    <!-- Header  -->
    <section class="pt-12">
        <div class="w-full px-4 md:flex justify-center md:justify-between justify-items-center">
            <div class="flex w-full justify-center md:justify-start md:w-1/2">
                <ol class="flex h-8 overflow-hidden space-x-2 rounded-lg">
                    <li class="flex items-center">
                        <x-routenav href="{{ route('list.role') }}">
                            <x-zondicon-list class="w-4 h-4" />
                            <span class="ms-1">{{ __('all') }}</span>
                        </x-routenav>
                    </li>

                    <li class="relative flex items-center">
                        <x-routenav href="{{ route('edit.role', $role->id) }}" wire:navigate>
                            <x-zondicon-reload class="w-4 h-4" />
                        </x-routenav>
                    </li>

                    <li class="relative flex items-center">
                        <a href="{{ route('create.role') }}" class="inline">
                            <x-custom-primary-button
                                class="h-8 text-white bg-green-700 dark:bg-green-700 hover:bg-green-600 dark:hover:bg-green-600 focus:bg-green-600 dark:focus:bg-green-600 active:bg-green-600 dark:active:bg-green-600">
                                <x-fas-plus class="w-4 h-4 mr-2.5" />
                                {{ __('add-new') }}
                            </x-custom-primary-button>
                        </a>
                    </li>
                </ol>
            </div>

            <div class="flex w-full md:w-1/2 pt-4 md:pt-0 justify-center md:justify-end items-center dark:text-white">
                <x-fas-users class="w-5 h-5" />
                <span class="ms-1 font-medium">{{ $role->name }}</span>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="w-full md:px-4 py-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form method="post" action="{{ route('update.role') }}" class="px-4 pb-6 space-y-6">
                @csrf
                @method('patch')

                <x-text-input name="id" type="hidden" :value="$role->id" />

                <div class="space-y-4 md:flex md:space-y-0 md:space-x-4">
                    <!-- Name -->
                    <div class="w-full md:w-full">
                        <x-input-label for="name" :value="__('name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $role->name)" autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <x-danger-button class="h-10" name="action" value="delete">
                        <x-fas-trash-can class="w-4 h-4" />
                        <span class="ms-1 font-medium">{{ __('Delete') }}</span>
                    </x-danger-button>

                    <x-primary-button class="h-10" name="action" value="save">
                        <x-zondicon-save-disk class="w-4 h-4" />
                        <span class="ms-1 font-medium">{{ __('Save') }}</span>
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="flex w-full py-6 justify-start items-center dark:text-white">
            <x-fas-users class="w-5 h-5" />
            <span class="ms-1 font-medium">{{ __('permissions') }}</span>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('assign.permission') }}" method="post">
                <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                @csrf

                <x-text-input name="id" type="hidden" :value="$role->id" />

                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">{{ __('name') }}</th>
                                            <th scope="col" class="px-6 py-4">{{ __('list') }}</th>
                                            <th scope="col" class="px-6 py-4">{{ __('view') }}</th>
                                            <th scope="col" class="px-6 py-4">{{ __('create') }}</th>
                                            <th scope="col" class="px-6 py-4">{{ __('update') }}</th>
                                            <th scope="col" class="px-6 py-4">{{ __('delete') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissionModels as $permissionModel)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                    {{ $permissionModel }}
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4 justify-center">
                                                    <x-text-input id="is_admin" name="list_{{ $permissionModel }}"
                                                        type="checkbox" value="1" :custom_text="'text-blue-600 dark:text-blue-600'"
                                                        class="bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600"
                                                        :checked="old(
                                                            'list_' . $permissionModel,
                                                            $role->hasPermissionTo('list_' . $permissionModel),
                                                        )" />
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4 justify-center">
                                                    <x-text-input id="is_admin" name="view_{{ $permissionModel }}"
                                                        type="checkbox" value="1" :custom_text="'text-blue-600 dark:text-blue-600'"
                                                        class="bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600"
                                                        :checked="old(
                                                            'view_' . $permissionModel,
                                                            $role->hasPermissionTo('view_' . $permissionModel),
                                                        )" />
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4 justify-center">
                                                    <x-text-input id="is_admin" name="create_{{ $permissionModel }}"
                                                        type="checkbox" value="1" :custom_text="'text-green-600 dark:text-green-600'"
                                                        class="bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600"
                                                        :checked="old(
                                                            'create_' . $permissionModel,
                                                            $role->hasPermissionTo('create_' . $permissionModel),
                                                        )" />
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4 justify-center">
                                                    <x-text-input id="is_admin" name="update_{{ $permissionModel }}"
                                                        type="checkbox" value="1" :custom_text="'text-blue-600 dark:text-blue-600'"
                                                        class="bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600"
                                                        :checked="old(
                                                            'update_' . $permissionModel,
                                                            $role->hasPermissionTo('update_' . $permissionModel),
                                                        )" />
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4 justify-center">
                                                    <x-text-input id="is_admin" name="delete_{{ $permissionModel }}"
                                                        type="checkbox" value="1" :custom_text="'text-red-600 dark:text-red-600'"
                                                        class="bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600"
                                                        :checked="old(
                                                            'delete_' . $permissionModel,
                                                            $role->hasPermissionTo('delete_' . $permissionModel),
                                                        )" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end md:px-4 py-4">
                        <x-primary-button class="h-10" name="action" value="save">
                            <x-zondicon-save-disk class="w-4 h-4" />
                            <span class="ms-1 font-medium">{{ __('Save') }}</span>
                        </x-primary-button>
                    </div>
            </form>

        </div>
    </section>
</x-app-layout>
