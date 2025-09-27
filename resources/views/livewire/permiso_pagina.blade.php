<?php

use Livewire\Volt\Component;

use Spatie\Permission\Models\Permission;

new class extends Component {
    public $permissions = [];

    public $headers = [];

    // Para mostrar/ocultar la tabla de permisos existentes o nuevos
    public $showExistingTable = false;
    public $showNewTable = false;

    public function mount(): void
    {
        $headers = [['key' => 'id', 'label' => '#'], ['key' => 'name', 'label' => __('Name')]];
    }

    public function loadPermissions($new_permissions): void
    {
        if ($new_permissions) {
            $this->showExistingTable = false;
            $this->showNewTable = true;
        }

        if (!$new_permissions) {
            $this->showNewTable = false;
            $this->showExistingTable = true;

            $this->permissions = Permission::all()
                ->where('is_custom', '=', false)
                ->map(function ($permission) {
                    return [
                        'module' => explode('.', $permission->name)[0],
                        'permission' => $permission->name,
                    ];
                })
                ->groupBy('module')
                ->map(function ($permissions, $module) {
                    return $permissions->pluck('permission')->toArray();
                })
                ->toArray();
        }
    }
}; ?>

<div>
    <div class="flex items-center justify-center gap-4 mt-2">
        <x-mary-button class="btn-success" icon="o-shield-check" label="{{ __('Load existing permissions') }}"
            wire:click="loadPermissions(false)" spinner />
        <x-mary-button class="btn-info" icon="o-arrow-up-on-square-stack" label="{{ __('Load new permissions') }}"
            wire:click="loadPermissions(true)" spinner />
    </div>

    {{-- Listado de permisos ya existentes --}}
    <div x-show="$wire.showExistingTable" class="mt-4">
        <div
            class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
            <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
                <thead
                    class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                    <tr>
                        <th scope="col" class="p-4">CustomerID</th>
                        <th scope="col" class="p-4">Name</th>
                        <th scope="col" class="p-4">Email</th>
                        <th scope="col" class="p-4">Membership</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline dark:divide-outline-dark">
                    <tr class="even:bg-primary/5 dark:even:bg-primary-dark/10">
                        <td class="p-4">2335</td>
                        <td class="p-4">Alice Brown</td>
                        <td class="p-4">alice.brown@penguinui.com</td>
                        <td class="p-4">Silver</td>
                    </tr>
                    <tr class="even:bg-primary/5 dark:even:bg-primary-dark/10">
                        <td class="p-4">2338</td>
                        <td class="p-4">Bob Johnson</td>
                        <td class="p-4">johnson.bob@penguinui.com</td>
                        <td class="p-4">Gold</td>
                    </tr>
                    <tr class="even:bg-primary/5 dark:even:bg-primary-dark/10">
                        <td class="p-4">2342</td>
                        <td class="p-4">Sarah Adams</td>
                        <td class="p-4">s.adams@penguinui.com</td>
                        <td class="p-4">Gold</td>
                    </tr>
                    <tr class="even:bg-primary/5 dark:even:bg-primary-dark/10">
                        <td class="p-4">2345</td>
                        <td class="p-4">Alex Martinez</td>
                        <td class="p-4">alex.martinez@penguinui.com</td>
                        <td class="p-4">Gold</td>
                    </tr>
                    <tr class="even:bg-primary/5 dark:even:bg-primary-dark/10">
                        <td class="p-4">2346</td>
                        <td class="p-4">Ryan Thompson</td>
                        <td class="p-4">ryan.thompson@penguinui.com</td>
                        <td class="p-4">Silver</td>
                    </tr>
                    <tr class="even:bg-primary/5 dark:even:bg-primary-dark/10">
                        <td class="p-4">2349</td>
                        <td class="p-4">Emily Rodriguez</td>
                        <td class="p-4">emily.rodriguez@penguinui.com</td>
                        <td class="p-4">Gold</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
