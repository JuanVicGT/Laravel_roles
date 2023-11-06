<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAllPermissions();
    }

    /**
     * The function getAllMenus returns an array containing the nav options.
     * 
     * @return array
     */
    private function getAllMenus(): array
    {
        return ['admin'];
    }

    /**
     * The function getAllModels returns an array containing the models.
     * 
     * @return array
     */
    private function getAllModels(): array
    {
        return ['user'];
    }

    /**
     * The function "getFullPermissions" returns an array of all permissions
     * 
     * @return array
     */
    private function getAllPermissions(): array
    {
        return ['list', 'view', 'create', 'update', 'delete'];
    }

    private function createAllPermissions()
    {
        /// Nav menu
        foreach ($this->getAllMenus() as $menu) {
            $permissionPath = "menu_{$menu}";
            Permission::create(['name' => $permissionPath]);
        }

        /// Models permissions
        foreach ($this->getAllModels() as $model) {
            foreach ($this->getAllPermissions() as $permission) {
                $permissionPath = "{$permission}_{$model}";
                Permission::create(['name' => $permissionPath]);
            }
        }
    }
}
