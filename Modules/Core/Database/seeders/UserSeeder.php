<?php

namespace Modules\Core\database\seeders;

use Illuminate\Database\Seeder;

use Modules\Core\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'username' => 'admin',
            'is_admin' => true
        ]);
    }
}
