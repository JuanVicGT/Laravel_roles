<x-app-layout>

    @section('tab-title', __('Create User'))

    <!-- Encabezado según tab activo -->
    <x-slot name="header">
        <x-mary-header title="{{ __('Create User') }}" class="mb-5">
            <x-slot:actions>
                <x-mary-button icon="o-arrow-left" label="{{ __('Return') }}" class="btn-primary text-white"
                    link="{{ route('user_managment.index') }}" no-wire-navigate />
            </x-slot:actions>
        </x-mary-header>
    </x-slot>

    <x-card class="px-4 py-6">
    </x-card>

</x-app-layout>
