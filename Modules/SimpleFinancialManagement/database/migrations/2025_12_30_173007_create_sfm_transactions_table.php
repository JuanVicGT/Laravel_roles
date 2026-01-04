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
        Schema::create('sfm_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('wallet_id')->nullable()->constrained('sfm_wallets')->nullOnDelete();
            $table->foreignId('bucket_id')->nullable()->constrained('sfm_buckets')->nullOnDelete();
            $table->foreignId('subcategory_id')->nullable()->constrained('sfm_subcategories')->nullOnDelete();
            $table->foreignId('credit_card_id')->nullable()->constrained('sfm_credit_cards')->nullOnDelete();

            $table->foreignId('related_transaction_id')
                ->nullable()
                ->constrained('sfm_transactions')
                ->nullOnDelete();

            $table->string('type', 30);
            $table->string('origin', 20)->nullable();
            $table->string('card_tx_type', 30)->nullable();

            $table->decimal('amount', 14, 2);
            $table->string('currency', 10)->default('GTQ');

            $table->text('description')->nullable();
            $table->date('date');
            $table->boolean('reconciled')->default(false);

            $table->json('metadata')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfm_transactions');
    }
};
