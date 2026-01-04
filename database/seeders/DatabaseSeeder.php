<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\Core\database\seeders\UserSeeder;
use Modules\SimpleFinancialManagement\database\seeders\WalletSeeder;
use Modules\SimpleFinancialManagement\database\seeders\BucketSeeder;
use Modules\SimpleFinancialManagement\database\seeders\BucketDefaultSeeder;
use Modules\SimpleFinancialManagement\database\seeders\SubcategorySeeder;
use Modules\SimpleFinancialManagement\database\seeders\CreditCardSeeder;
use Modules\SimpleFinancialManagement\database\seeders\CardCycleSeeder;
use Modules\SimpleFinancialManagement\database\seeders\TagSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            UserSeeder::class,
            WalletSeeder::class,
            BucketSeeder::class,
            BucketDefaultSeeder::class,
            SubcategorySeeder::class,
            CreditCardSeeder::class,
            CardCycleSeeder::class,
            TagSeeder::class
        ]);
    }
}
