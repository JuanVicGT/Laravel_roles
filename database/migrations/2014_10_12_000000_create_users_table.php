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
        Schema::create('users', function (Blueprint $table) {
            // Required
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->rememberToken();
            $table->string('password');
            $table->string('email')->unique();
            $table->tinyInteger('level')->nullable();
            $table->string('username')->unique();

            // Optional
            $table->string('lastip')->nullable();
            $table->boolean('admin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
