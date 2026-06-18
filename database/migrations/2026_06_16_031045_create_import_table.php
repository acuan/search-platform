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
        Schema::create('imports', function (Blueprint $table) {

            $table->id();

            $table->foreignId('source_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('filename');
            $table->string('storage_path');
            $table->unsignedBigInteger('file_size')
                ->default(0);
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed'
            ])->default('pending');
            $table->unsignedBigInteger('total_chunks')
                ->default(0);
            $table->unsignedBigInteger('processed_chunks')
                ->default(0);
            $table->unsignedBigInteger('records_total')
                ->default(0);
            $table->unsignedBigInteger('records_processed')
                ->default(0);
            $table->text('error_message')
                ->nullable();
            $table->timestamp('started_at')
                ->nullable();
            $table->timestamp('completed_at')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};
