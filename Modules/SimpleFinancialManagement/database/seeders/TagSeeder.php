<?php

namespace Modules\SimpleFinancialManagement\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\SimpleFinancialManagement\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::insert([
            ['user_id' => 1, 'name' => 'necesario'],
            ['user_id' => 1, 'name' => 'urgente'],
            ['user_id' => 1, 'name' => 'gusto'],
        ]);
    }
}
