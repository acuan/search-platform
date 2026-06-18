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
        Schema::create('source_field_mappings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('source_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('global_field_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('source_field');
            $table->timestamps();

            $table->unique([
                'source_id',
                'source_field'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_field_mappings');
    }
};
