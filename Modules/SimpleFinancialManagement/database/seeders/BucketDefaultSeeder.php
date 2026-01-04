<?php

namespace Modules\SimpleFinancialManagement\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\SimpleFinancialManagement\Models\BucketDefault;
use Carbon\Carbon;

class BucketDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BucketDefault::insert([
            [
                'bucket_id' => 1,
                'effective_from' => Carbon::now()->startOfMonth(),
                'amount' => 1500,
                'note' => 'Gastos fijos iniciales',
            ],
            [
                'bucket_id' => 2,
                'effective_from' => Carbon::now()->startOfMonth(),
                'amount' => 3000,
                'note' => 'Apoyo familiar',
            ],
            [
                'bucket_id' => 3,
                'effective_from' => Carbon::now()->startOfMonth(),
                'amount' => 500,
                'note' => 'Ahorro base',
            ],
            [
                'bucket_id' => 4,
                'effective_from' => Carbon::now()->startOfMonth(),
                'amount' => 700,
                'note' => 'Gustos',
            ],
        ]);
    }
}
