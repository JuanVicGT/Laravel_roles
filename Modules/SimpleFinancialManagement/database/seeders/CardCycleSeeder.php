<?php

namespace Modules\SimpleFinancialManagement\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\SimpleFinancialManagement\Models\CardCycle;
use Carbon\Carbon;

class CardCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CardCycle::create([
            'credit_card_id' => 1,
            'period_start' => Carbon::now()->subMonth()->startOfMonth(),
            'period_end' => Carbon::now()->subMonth()->endOfMonth(),
            'statement_amount' => 0,
        ]);
    }
}
