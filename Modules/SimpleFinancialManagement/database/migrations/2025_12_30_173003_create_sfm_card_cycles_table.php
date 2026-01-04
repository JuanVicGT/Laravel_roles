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
        Schema::create('sfm_card_cycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_card_id')->constrained('sfm_credit_cards')->cascadeOnDelete();

            $table->date('period_start');
            $table->date('period_end');

            $table->decimal('statement_amount', 14, 2)->default(0);
            $table->date('statement_date')->nullable();
            $table->date('due_date')->nullable();

            $table->decimal('paid_amount', 14, 2)->default(0);
            $table->date('paid_date')->nullable();

            $table->decimal('interest_charged', 14, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfm_card_cycles');
    }
};
