<?php

namespace Modules\SimpleFinancialManagement\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\SimpleFinancialManagement\Models\Bucket;

class BucketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bucket::insert([
            [
                'user_id' => 1,
                'name' => 'Gastos Obligatorios',
                'description' => 'Pagos fijos mensuales',
                'kind' => 'obligatorio',
            ],
            [
                'user_id' => 1,
                'name' => 'Fondo Familiar',
                'description' => 'Apoyo a la familia',
                'kind' => 'familiar',
            ],
            [
                'user_id' => 1,
                'name' => 'Ahorro',
                'description' => 'Ahorro mensual',
                'kind' => 'ahorro',
            ],
            [
                'user_id' => 1,
                'name' => 'Gustos',
                'description' => 'Comida, ocio, etc',
                'kind' => 'gusto',
            ],
        ]);
    }
}
