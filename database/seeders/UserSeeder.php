<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUsers();
        $this->createEmployeeUsers();
    }

    private function createAdminUsers(): void
    {
        // Create users
        User::factory()->create([
            'admin' => true,
            'level' => 99,
            'name' => 'JuanV',
            'username' => 'admin',
            'email' => 'JuanEscobarGT@outlook.com',
        ]);
    }

    private function createEmployeeUsers(string $roleName = 'employee'): void
    {
        $role = Role::findByName($roleName);

        // Create users
        $user = User::factory()->create([
            'level' => 10,
            'name' => 'RudeN',
            'username' => 'user1',
            'email' => 'preubecitas@gmail.com',
        ]);
        $user->assignRole($role);
    }
}
