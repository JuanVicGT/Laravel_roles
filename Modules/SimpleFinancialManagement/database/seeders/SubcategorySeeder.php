<?php

namespace Modules\SimpleFinancialManagement\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\SimpleFinancialManagement\Models\Subcategory;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcategory::insert([
            ['bucket_id' => 1, 'name' => 'Servicios'],
            ['bucket_id' => 1, 'name' => 'Internet'],
            ['bucket_id' => 4, 'name' => 'Comida a domicilio'],
            ['bucket_id' => 4, 'name' => 'Suscripciones'],
            ['bucket_id' => 2, 'name' => 'Apoyo mensual'],
        ]);
    }
}
