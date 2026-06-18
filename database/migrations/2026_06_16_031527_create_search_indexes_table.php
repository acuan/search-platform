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
        Schema::create('search_indexes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('source_id')
                ->constrained();

            $table->string('index_name');

            $table->bigInteger('documents_count')
                ->default(0);

            $table->timestamp('last_sync_at')
                ->nullable();
            $table->enum('status', [
                'pending',
                'indexing',
                'completed',
                'failed'
            ]);

            $table->text('last_error')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_indexes');
    }
};
