<div class="w-full">
    <div class="max-w-screen">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden" x-data="{ expanded: false }">

            <!-- Header -->
            <section class="w-full p-4">
                <div class="md:flex items-center justify-between">
                    <div class="block md:flex w-full pr-4">
                        <x-text-input id="search" class="block w-full" type="text" name="search" autofocus
                            placeholder="{{ __('Search') }}" wire:model="search" wire:keydown.enter="$refresh" />
                    </div>

                    <!-- Action Buttons (include filter button) -->
                    <div class="justify-center flex pt-4 md:pt-0 space-x-3">
                        @include('livewire.datatable.components.table-action-buttons')
                    </div>
                </div>
            </section>

            <!-- Table -->
            <section>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-100">
                        <thead
                            class="text-xsuppercase dark:text-gray-200 border bg-gray-200 dark:bg-gray-600 border-gray-300 dark:border-gray-600">
                            <tr>
                                @include('livewire.datatable.components.table-sortable-th', [
                                    'name' => 'name',
                                    'displayName' => 'Name',
                                ])
                                @include('livewire.datatable.components.table-sortable-th', [
                                    'name' => 'updated_at',
                                    'displayName' => 'Last Update',
                                ])
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr wire:key="{{ $permission->id }}"
                                    class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-4 py-3 font-medium whitespace-nowrap">
                                        {{ $permission->name }}</th>
                                    <td class="px-4 py-3">{{ $permission->updated_at }}</td>
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
                        {{ $permissions->links('livewire.datatable.components.pagination-links') }}
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
