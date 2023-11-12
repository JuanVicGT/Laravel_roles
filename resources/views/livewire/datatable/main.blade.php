<div>
    <section class="w-full">
        <div class="max-w-screen">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden"
                x-data="{ expanded: false }">

                <!-- Header -->
                <section class="w-full p-4">
                    <div class="md:flex items-center justify-between">
                        <div class="block md:flex w-full pr-4">
                            <x-text-input id="search" class="block w-full" type="text" name="search"
                                placeholder="{{ __('Search') }}" wire:model="search" />
                        </div>

                        <!-- Action Buttons (include filter button) -->
                        <div class="justify-center flex pt-4 md:pt-0 space-x-3">
                            @include('livewire.datatable.components.table-action-buttons')
                        </div>
                    </div>

                    <!-- Filters -->
                    <div x-data="{ ghost: false }" x-show="expanded"
                        x-transition:enter="transform ease-in duration-300 transition"
                        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                        x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" class="w-full py-2.5 space-y-2">
                        @include('livewire.datatable.components.table-filters')
                    </div>
                </section>

                <!-- Table -->
                <section>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-100">
                            <thead
                                class="text-xsuppercase dark:text-gray-200 border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600">
                                <tr>
                                    @include('livewire.datatable.components.table-sortable-th', [
                                        'name' => 'name',
                                        'displayName' => 'Name',
                                    ])
                                    @include('livewire.datatable.components.table-sortable-th', [
                                        'name' => 'email',
                                        'displayName' => 'Email',
                                    ])
                                    @include('livewire.datatable.components.table-sortable-th', [
                                        'name' => 'admin',
                                        'displayName' => 'Role',
                                    ])
                                    @include('livewire.datatable.components.table-sortable-th', [
                                        'name' => 'id',
                                        'displayName' => 'id',
                                    ])
                                    @include('livewire.datatable.components.table-sortable-th', [
                                        'name' => 'updated_at',
                                        'displayName' => 'Last Update',
                                    ])
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr wire:key="{{ $user->id }}" class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $user->name }}</th>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3 {{ $user->admin ? 'text-green-500' : 'text-blue-500' }}">
                                            {{ $user->admin ? 'Admin' : 'Member' }}</td>
                                        <td class="px-4 py-3">{{ $user->id }}</td>
                                        <td class="px-4 py-3">{{ $user->updated_at }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <div class="flex justify-center pt-4 md:pt-0 space-x-3">
                                                <a href="{{ route('edit.user', $user->id) }}">
                                                    <x-hover-button
                                                        class="hover:bg-yellow-500 text-yellow-700 dark:text-yellow-500 border-yellow-500">
                                                        <x-fas-pencil class="w-5 h-5" />
                                                    </x-hover-button>
                                                </a>
                                                <x-hover-button
                                                    x-on:click="$dispatch('open-modal', 'confirm-user-deletion')"
                                                    class="hover:bg-red-500 text-red-700 dark:text-red-500 border-red-500">
                                                    <x-fas-trash-can class="w-5 h-5" />
                                                </x-hover-button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Footer -->
                <section class="py-4 px-3">
                    <div class="md:flex md:justify-normal">
                        <div class="hidden md:flex md:space-x-4 items-center">
                            <label
                                class="w-32 text-sm font-medium text-gray-800 dark:text-gray-200">{{ __('Show') }}</label>
                            <select wire:model.live='perPage'
                                class="text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="7">7</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="w-full">
                            {{ $users->links('livewire.datatable.components.pagination-links') }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!-- Modals -->
    <section>
        <x-modal name="confirm-user-deletion" focusable>
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6 flex justify-between">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3" >
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </div>
        </x-modal>
    </section>
</div>
