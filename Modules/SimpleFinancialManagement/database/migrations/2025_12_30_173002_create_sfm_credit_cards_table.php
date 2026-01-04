<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sfm_credit_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('name', 100);
            $table->string('bank', 100);
            $table->string('currency', 10);

            $table->decimal('credit_limit', 14, 2);
            $table->tinyInteger('billing_day');
            $table->tinyInteger('payment_due_day');

            $table->decimal('annual_rate_pct', 6, 3);
            $table->decimal('monthly_rate_pct', 6, 3)->nullable();

            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfm_credit_cards');
    }
};
