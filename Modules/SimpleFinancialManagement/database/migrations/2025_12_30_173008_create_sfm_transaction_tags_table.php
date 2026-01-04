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
        Schema::create('sfm_transaction_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('sfm_transactions')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('sfm_tags')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfm_transaction_tags');
    }
};
