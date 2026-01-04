<?php

namespace Modules\SimpleFinancialManagement\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\SimpleFinancialManagement\Models\CreditCard;

class CreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CreditCard::create([
            'user_id' => 1,
            'name' => 'BAC Visa',
            'bank' => 'BAC',
            'currency' => 'GTQ',
            'credit_limit' => 5000,
            'billing_day' => 9,
            'payment_due_day' => 2,
            'annual_rate_pct' => 64.80,
            'monthly_rate_pct' => 5.41,
            'active' => true,
        ]);
    }
}
