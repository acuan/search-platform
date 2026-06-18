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
        Schema::create('source_objects', function (Blueprint $table) {

            $table->id();
            $table->foreignId('source_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('object_name');
            $table->string('object_type')
                ->default('table');
            $table->boolean('is_active')
                ->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_objects');
    }
};
