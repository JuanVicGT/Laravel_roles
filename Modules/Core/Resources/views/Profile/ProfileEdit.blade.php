<x-app-layout :tab_title="__('Edit User')">

    <!-- Encabezado según tab activo -->
    <x-slot name="header">
        <div class="flex items-center mb-5 gap-2">
            <span>
                <i class="fas fa-user-circle fa-2x"></i>
            </span>
            <x-mary-header title="{{ __('User') }}" subtitle="{{ $user->name }}" class="mb-0! w-full items-center">
                <x-slot:actions>
                    {{-- En la edición de perfil, se regresa al Dashboard --}}
                    <x-mary-button icon="o-home" label="{{ __('Dashboard') }}" class="btn-primary text-white"
                        link="{{ route('dashboard') }}" no-wire-navigate />
                </x-slot:actions>
            </x-mary-header>
        </div>
    </x-slot>

    <section x-data="{ submitButtonDisabled: false }">
        {{-- Form to update user --}}
        <x-mary-card shadow>
            <x-mary-form method="POST" action="{{ route('profile.update') }}"
                x-on:submit="submitButtonDisabled = true">

                @csrf
                @method('PATCH')

                {{-- Hidden Inputs --}}
                <input type="hidden" name="id" value="{{ $user->id }}">

                {{-- User Inputs --}}
                <div class="grid sm:grid-cols-2 gap-4">

                    <div>
                        <x-mary-input label="{{ __('Name') }}" name="name" value="{{ $user->name }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-mary-input label="{{ __('Email') }}" name="email" value="{{ $user->email }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <x-cmary-select label="{{ __('Language') }}" name="locale" :options="[['id' => 'en', 'name' => __('English')], ['id' => 'es', 'name' => __('Spanish')]]" :selected="$user->locale"
                        icon="fa-solid fa-language" />

                </div>

                <!-- Submit Button -->
                <div class="w-full mt-4 flex justify-end">
                    <x-mary-button type="submit" class="btn-success" x-bind:disabled="submitButtonDisabled">
                        <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                        <div x-show="!submitButtonDisabled">
                            <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M48 96V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V170.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H309.5c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8V184c0 13.3-10.7 24-24 24H104c-13.3 0-24-10.7-24-24V80H64c-8.8 0-16 7.2-16 16zm80-16v80H272V80H128zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z" />
                            </svg> {{ __('Save') }}
                        </div>
                    </x-mary-button>
                </div>

            </x-mary-form>
        </x-mary-card>

        {{-- Form to change password --}}
        <x-mary-card class="mt-6" title="{{ __('Change Password') }}"
            subtitle="{{ __('Ensure your account is using a long, random password to stay secure.') }}" shadow
            separator>
            <form method="post" action="{{ route('profile.password.update') }}"
                x-on:submit="submitButtonDisabled = true">
                @csrf
                @method('put')

                <div class="grid sm:grid-cols-1 gap-4">

                    <div x-data="{ show_1: false }">
                        <span>{{ __('Current Password') }}</span>
                        <div class="flex items-center">
                            <input id="update_password_current_password" name="current_password"
                                class="input input-primary w-full peer" autocomplete="current-password"
                                :type="show_1 ? 'text' : 'password'">
                            <a class="absolute right-8 cursor-pointer" :class="{ 'hidden': !show_1, 'block': show_1 }"
                                @click="show_1 = !show_1"><i class="fa-solid fa-eye"></i></a>
                            <a class="absolute right-8 cursor-pointer" :class="{ 'hidden': show_1, 'block': !show_1 }"
                                @click="show_1 = !show_1"><i class="fa-solid fa-eye-slash"></i></a>
                            </input>
                        </div>
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div x-data="{ show_2: false }">
                        <span>{{ __('New Password') }}</span>
                        <div class="flex items-center">
                            <input id="update_password_password" name="password" class="input input-primary w-full peer"
                                autocomplete="new-password" :type="show_2 ? 'text' : 'password'">
                            <a class="absolute right-8 cursor-pointer" :class="{ 'hidden': !show_2, 'block': show_2 }"
                                @click="show_2 = !show_2"><i class="fa-solid fa-eye"></i></a>
                            <a class="absolute right-8 cursor-pointer" :class="{ 'hidden': show_2, 'block': !show_2 }"
                                @click="show_2 = !show_2"><i class="fa-solid fa-eye-slash"></i></a>
                            </input>
                        </div>
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div x-data="{ show_3: false }">
                        <span>{{ __('Confirm Password') }}</span>
                        <div class="flex items-center">
                            <input id="update_password_password_confirmation" name="password_confirmation"
                                class="input input-primary w-full peer" autocomplete="new-password"
                                :type="show_3 ? 'text' : 'password'">
                            <a class="absolute right-8 cursor-pointer" :class="{ 'hidden': !show_3, 'block': show_3 }"
                                @click="show_3 = !show_3"><i class="fa-solid fa-eye"></i></a>
                            <a class="absolute right-8 cursor-pointer" :class="{ 'hidden': show_3, 'block': !show_3 }"
                                @click="show_3 = !show_3"><i class="fa-solid fa-eye-slash"></i></a>
                            </input>
                        </div>
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <x-mary-button type="submit" class="btn-success" x-bind:disabled="submitButtonDisabled">
                        <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                        <div x-show="!submitButtonDisabled">
                            <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M48 96V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V170.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H309.5c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8V184c0 13.3-10.7 24-24 24H104c-13.3 0-24-10.7-24-24V80H64c-8.8 0-16 7.2-16 16zm80-16v80H272V80H128zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z" />
                            </svg> {{ __('Save') }}
                        </div>
                    </x-mary-button>
                </div>

            </form>
        </x-mary-card>
    </section>


</x-app-layout>
