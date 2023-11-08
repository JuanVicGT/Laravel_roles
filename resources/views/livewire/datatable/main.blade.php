<div>
    <section class="w-full">
        <div class="max-w-screen">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div x-data="{ expanded: false }">
                    <button
                        class="bg-transparent p-2 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white border border-blue-500 hover:border-transparent rounded"
                        @click="expanded = ! expanded">
                        <x-zondicon-filter class="w-5 h-5" />
                    </button>

                    <div x-data="{ expanded: false }" x-show="expanded"
                        x-transition:enter="transform ease-out duration-300 transition"
                        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
                        lorem ispm
                    </div>
                </div>
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-100"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="text-gray-800 dark:text-gray-200 border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                        <div class="relative px-4">

                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label
                                class="w-40 text-sm font-medium text-gray-800 dark:text-gray-200">{{ __('User Type :') }}</label>
                            <select
                                class="text-gray-800 dark:text-gray-200 border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
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
                                    <td class="px-4 py-3 {{ $user->is_admin ? 'text-green-500' : 'text-blue-500' }}">
                                        {{ $user->is_admin ? 'Admin' : 'Member' }}</td>
                                    <td class="px-4 py-3">{{ $user->id }}</td>
                                    <td class="px-4 py-3">{{ $user->updated_at }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button
                                            onclick="confirm('Are you sure you want to delete {{ $user->name }} ?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $user->id }})"
                                            class="px-3 py-1 bg-red-500 text-white rounded">X</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex justify-normal">
                        <div class="flex space-x-4 items-center">
                            <label
                                class="w-32 text-sm font-medium text-gray-800 dark:text-gray-200">{{ __('Show') }}</label>
                            <select wire:model.live='perPage'
                                class="text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
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
                </div>
            </div>
        </div>
    </section>
</div>
