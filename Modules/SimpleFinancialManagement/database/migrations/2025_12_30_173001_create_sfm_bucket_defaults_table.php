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
        Schema::create('sfm_bucket_defaults', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bucket_id')->constrained('sfm_buckets')->cascadeOnDelete();
            $table->date('effective_from');
            $table->decimal('amount', 14, 2);
            $table->string('note', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfm_bucket_defaults');
    }
};
