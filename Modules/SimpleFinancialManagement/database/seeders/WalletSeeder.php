<?php

namespace Modules\SimpleFinancialManagement\database\seeders;

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
        Wallet::insert([
            [
                'user_id' => 1,
                'name' => 'Efectivo',
                'type' => 'cash',
                'currency' => 'GTQ',
                'balance' => 0,
            ],
            [
                'user_id' => 1,
                'name' => 'Cuenta Débito',
                'type' => 'debit',
                'currency' => 'GTQ',
                'balance' => 0,
            ],
            [
                'user_id' => 1,
                'name' => 'Cuenta Ahorro',
                'type' => 'saving',
                'currency' => 'GTQ',
                'balance' => 0,
            ],
            [
                'user_id' => 1,
                'name' => 'Cuenta Crédito',
                'type' => 'credit',
                'currency' => 'GTQ',
                'balance' => 0,
            ],
        ]);
    }
}
