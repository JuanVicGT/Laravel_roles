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

    private function getMenuWithModels(): array
    {
        return ['admin' => ['user', 'role', 'permission']];
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
        /// Nav menu how key and the model how value
        foreach ($this->getMenuWithModels() as $menu => $models) {
            foreach ($models as $model) {
                $this->createPermission($model, $menu);
            }
        }
    }

    private function createPermission($model, $menu)
    {
        foreach ($this->getAllPermissions() as $permission) {
            Permission::create(['name' => "{$permission}_{$model}", 'menu' => $menu]);
        }
    }
}
