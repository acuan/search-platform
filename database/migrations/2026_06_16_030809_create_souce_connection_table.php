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
        Schema::create('source_connections', function (Blueprint $table) {

            $table->id();

            $table->foreignId('source_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('host')->nullable();

            $table->integer('port')->nullable();

            $table->string('database')->nullable();

            $table->string('schema')->nullable();

            $table->string('username')->nullable();

            $table->text('password')->nullable();

            $table->string('table_name')->nullable();

            $table->string('file_path')->nullable();

            $table->json('settings')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('souce_connection');
    }
};
