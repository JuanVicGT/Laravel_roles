<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 30)->unique(); // required - login
            $table->boolean('is_admin')->nullable();
            $table->boolean('is_active')->nullable();

            $table->enum('type_layout', ['navbar', 'sidebar', 'both', 'default'])->default('both')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
