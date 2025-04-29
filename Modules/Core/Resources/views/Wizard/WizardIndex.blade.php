@php
    $pages_no = 1;
    $permissions_no = 1;

    // Se procesan los menús y submenús con sus respectivas rutas para cargarlos dinamicamente
    $pages_files = glob(base_path('Modules/*/pages.json'));

    // Genera el menú filtrado según los permisos del usuario
    $modules_pages = collect($pages_files)
        ->flatMap(function ($path) {
            $module = json_decode(file_get_contents($path), true);
            return $module['pages'] ?? [];
        })
        ->sortByDesc('priority')
        ->groupBy('menu')
        ->map(function ($pages) {
            return $pages->keyBy('permission')->toArray();
        })
        ->toArray();

    // Se procesan los menús y submenús con sus respectivas rutas para cargarlos dinamicamente
    $custom_permissions = glob(base_path('Modules/*/permissions.json'));

    // Genera el menú filtrado según los permisos del usuario, estos no manejan prioridad
    $modules_permissions = collect($custom_permissions)
        ->flatMap(function ($path) {
            $module = json_decode(file_get_contents($path), true);
            return $module['per_role'] ?? [];
        })
        ->toArray();
@endphp

<x-app-layout path="layouts.app" :tab_title="__('Wizard')">

    {{-- Form --}}
    <x-mary-card shadow class="w-full">
        <x-mary-form method="POST" action="{{ route('permission.reset') }}" x-data="{ submitButtonDisabled: false }"
            x-on:submit="submitButtonDisabled = true">
            @csrf

            <!-- name of each tab group should be unique -->
            <div class="tabs tabs-lift mb-10">
                <input type="radio" name="my_tabs_permissions" class="tab"
                    aria-label="{{ __('Tab Pages Permissions') }}" checked="checked" />
                <div class="tab-content bg-base-100 border-base-300 p-6">
                    <p class="mb-2 max-w-lg mx-auto text-left">
                        {{ __('Wizard Description') }}
                    </p>

                    <ul class="list-disc mb-2 max-w-lg mx-auto text-left">
                        <li>{{ __('Index') }}</li>
                        <li>{{ __('Store') }}</li>
                        <li>{{ __('Update') }}</li>
                        <li>{{ __('Delete') }}</li>
                        <li>{{ __('Destroy') }}</li>
                        <li>{{ __('Import') }}</li>
                        <li>{{ __('Export') }}</li>
                    </ul>

                    {{-- Header Submit Button --}}
                    <div class="w-full flex justify-end">
                        <div class="btn btn-warning" x-bind:disabled="submitButtonDisabled"
                            onclick="my_modal_2.showModal()">
                            <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                            <div x-show="!submitButtonDisabled">
                                <i class="fa-regular fa-floppy-disk text-xl"></i>
                                {{ __('Save Permissions') }}
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto mb-2">
                        <table class="table table-zebra">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>{{ __('No.') }}</th>
                                    <th>{{ __('Page') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- rows -->
                                @foreach ($modules_pages as $section => $pages)
                                    @empty($pages)
                                        @continue
                                    @endempty

                                    @foreach ($pages as $page)
                                        @empty($page)
                                            @continue
                                        @endempty

                                        <input type="hidden" name="pages[{{ $page['permission'] }}]"
                                            value="{{ $page['permission'] }}">

                                        <tr>
                                            <th>{{ $pages_no }}</th>
                                            <td>{{ $page['permission'] }}</td>
                                        </tr>

                                        @php $pages_no++; @endphp
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer Submit Button --}}
                    <div class="w-full flex justify-end">
                        <div class="btn btn-warning" x-bind:disabled="submitButtonDisabled"
                            onclick="my_modal_2.showModal()">
                            <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                            <div x-show="!submitButtonDisabled">
                                <i class="fa-regular fa-floppy-disk text-xl"></i>
                                {{ __('Save Permissions') }}
                            </div>
                        </div>
                    </div>
                </div>

                <input type="radio" name="my_tabs_permissions" class="tab"
                    aria-label="{{ __('Tab Custom Permissions') }}" />
                <div class="tab-content bg-base-100 border-base-300 p-6">
                    <p class="mb-2 max-w-lg mx-auto text-left">
                        {{ __('Custom Permissions') }}
                    </p>

                    {{-- Header Submit Button --}}
                    <div class="w-full flex justify-end">
                        <div class="btn btn-warning" x-bind:disabled="submitButtonDisabled"
                            onclick="my_modal_2.showModal()">
                            <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                            <div x-show="!submitButtonDisabled">
                                <i class="fa-regular fa-floppy-disk text-xl"></i>
                                {{ __('Save Permissions') }}
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto mb-2">
                        <table class="table table-zebra">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>{{ __('No.') }}</th>
                                    <th>{{ __('Permission') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- rows -->
                                @foreach ($modules_permissions as $permission)
                                    @empty($permission)
                                        @continue
                                    @endempty

                                    <input type="hidden" name="permissions[{{ $permission['name'] }}]"
                                        value="{{ $permission['name'] }}">

                                    <tr>
                                        <th>{{ $permissions_no }}</th>
                                        <td>{{ $permission['name'] }}</td>
                                    </tr>

                                    @php $permissions_no++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer Submit Button --}}
                    <div class="w-full flex justify-end">
                        <div class="btn btn-warning" x-bind:disabled="submitButtonDisabled"
                            onclick="my_modal_2.showModal()">
                            <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                            <div x-show="!submitButtonDisabled">
                                <i class="fa-regular fa-floppy-disk text-xl"></i>
                                {{ __('Save Permissions') }}
                            </div>
                        </div>
                    </div>

                </div>

            </div> <!-- END TABS -->

            <!-- Open the modal using ID.showModal() method -->
            <dialog id="my_modal_2" class="modal">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">{{ __('Reset Permissions?') }}</h3>
                    <p class="py-4">{{ __('Are you sure you want to reset permissions?') }}</p>
                    <div class="pt-4 flex justify-between">
                        <button type="button" class="btn" onclick="my_modal_2.close()">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-success" x-bind:disabled="submitButtonDisabled"
                            onclick="my_modal_2.showModal()">
                            <x-mary-loading class="text-primary" x-show="submitButtonDisabled" />
                            <div x-show="!submitButtonDisabled">
                                {{ __('Yes, Save Permissions') }}
                            </div>
                        </button>
                    </div>
                </div>
            </dialog>
        </x-mary-form>
    </x-mary-card>

</x-app-layout>
