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
        Schema::create('fm_movements', function (Blueprint $table) {
            $table->id();

            $table->date('date')->nullable();
            $table->text('description')->nullable();

            $table->double('income')->nullable();
            $table->double('expense')->nullable();

            $table->string('type', 100)->nullable();
            $table->string('addressee_name', 100)->nullable();

            $table->unsignedBigInteger('wallet_id')->nullable();
            $table->foreign('wallet_id')->references('id')->on('fm_wallets')->onDelete('cascade')->nullable();

            $table->unsignedBigInteger('addressee_id')->nullable();
            $table->foreign('addressee_id')->references('id')->on('fm_addressees')->onDelete('cascade')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fm_movements');
    }
};
