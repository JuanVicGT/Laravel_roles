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
        $this->createEmployeePermissions();
    }

    /**
     * The function "getFullPermissions" returns an array of all permissions
     * 
     * @return array
     */
    private function getFullPermissions(): array
    {
        return ['create', 'delete', 'view', 'edit', 'list'];
    }

    /**
     * The function returns an array of basic permissions.
     * 
     * @return array
     */
    private function getBasicPermissions(): array
    {
        return ['view', 'edit', 'list'];
    }

    /**
     * The function "getSimplePermissions" returns an array with the more basic permissions
     * 
     * @return array
     */
    private function getSimplePermissions(): array
    {
        return ['view', 'list'];
    }

    /**
     * The function "getPagesPermissions" returns an array of permissions for different pages
     * 
     * @return array<string, array>
     */
    private function getPagesPermissions(): array
    {
        return [
            'dashboard' => $this->getFullPermissions(),
            'products' => $this->getSimplePermissions()
        ];
    }

    /**
     * The function "getPagesPerRole" returns an array that maps roles to the pages accessible by each
     * role.
     * 
     * @return array
     */
    private function getPagesPerRole(): array
    {
        return [
            'employee' => [
                'dashboard'
            ]
        ];
    }


    /**
     * Assigns permissions to an employee role based on predefined pages
     * and permissions.
     * 
     * @param string
     */
    private function createEmployeePermissions(string $roleName = 'employee'): void
    {
        $role = Role::findByName($roleName);

        $pages = $this->getPagesPerRole();
        foreach ($pages[$roleName] as $page) {
            $pagesPermissions = $this->getPagesPermissions();

            foreach ($pagesPermissions[$page] as $permission) {
                $permissionPath = "{$permission}_{$page}";

                Permission::create(['name' => $permissionPath]);
                $role->givePermissionTo($permissionPath);
            }
        }
    }
}
