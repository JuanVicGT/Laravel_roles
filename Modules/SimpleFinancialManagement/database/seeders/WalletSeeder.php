<?php

namespace Modules\SimpleFinancialManagement\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\SimpleFinancialManagement\Models\Wallet;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wallet::create(
            [
                'name' => 'Efectivo',
                'amount' => 0
            ]
        );

        Wallet::create(
            [
                'name' => 'Ahorro',
                'amount' => 0
            ]
        );

        Wallet::create(
            [
                'name' => 'Crédito',
                'amount' => 0
            ]
        );

        Wallet::create(
            [
                'name' => 'Débito',
                'amount' => 0
            ]
        );
    }
}
