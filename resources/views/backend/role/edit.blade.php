<x-app-layout>

    @section('title', __('edit-user'))

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
        <div class="w-full px-6 md:flex justify-center md:justify-between justify-items-center">
            <div class="flex w-full justify-center md:justify-start md:w-1/2">
                <ol class="flex h-8 overflow-hidden space-x-2 rounded-lg">
                    <li class="flex items-center">
                        <x-routenav href="{{ route('list.user') }}">
                            <x-zondicon-list class="w-4 h-4" />
                            <span class="ms-1">{{ __('all') }}</span>
                        </x-routenav>
                    </li>

                    <li class="relative flex items-center">
                        <x-routenav href="{{ route('edit.user', $user->id) }}" wire:navigate>
                            <x-zondicon-reload class="w-4 h-4" />
                        </x-routenav>
                    </li>

                    <li class="relative flex items-center">
                        <x-routenav href="{{ route('create.user', $user->id) }}"
                            class="text-white bg-green-700 dark:bg-green-700 hover:bg-green-600 dark:hover:bg-green-600">
                            <x-fas-plus class="w-4 h-4" />
                            <span class="ms-1">{{ __('add-new') }}</span>
                        </x-routenav>
                    </li>
                </ol>
            </div>

            <div class="flex w-full md:w-1/2 pt-4 md:pt-0 justify-center md:justify-end items-center dark:text-white">
                <x-fas-users class="w-5 h-5" />
                <span class="ms-1 font-medium">{{ __('user') . ': ' . $user->name }}</span>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="w-full md:px-6 py-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form method="post" action="{{ route('update.user') }}" class="px-4 pb-6 space-y-6">
                @csrf
                @method('patch')

                <x-text-input name="id" type="hidden" :value="$user->id" />

                <div class="space-y-4 md:flex md:space-y-0 md:space-x-4">
                    <!-- Username -->
                    <div class="w-full md:w-1/3">
                        <x-input-label for="username" :value="__('username')" />
                        <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                            :value="old('username', $user->username)" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        <x-input-label :value="__('desc-username')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div class="w-full md:w-1/3">
                        <x-input-label for="name" :value="__('name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $user->name)" autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="w-full md:w-1/3">
                        <x-input-label for="email" :value="__('email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $user->email)" autocomplete="current-password" />
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-4 md:flex md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="w-full md:w-1/2">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full" autocomplete="new-password" />
                    </div>
                </div>

                <div class="flex space-x-4">
                    <!-- Is Admin -->
                    <div class="w-1/2 md:w-1/5">
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <x-text-input id="is_admin" name="is_admin" type="checkbox" value="1"
                                :checked="old('is_admin', $user->admin)" :custom_text="'text-blue-600 dark:text-blue-600'"
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600" />
                            <x-input-label for="is_admin" :value="__('is-admin')"
                                class="w-full py-4 ms-2 text-sm font-medium" />
                        </div>
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
    </section>
</x-app-layout>
