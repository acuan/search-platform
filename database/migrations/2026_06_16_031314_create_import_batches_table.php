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
        Schema::create('import_batches', function (Blueprint $table) {

            $table->id();
            $table->integer('chunk_number');
            $table->bigInteger('offset');
            $table->bigInteger('limit');
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed'
            ]);
            $table->text('error_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_batches');
    }
};
