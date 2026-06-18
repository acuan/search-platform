<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('source_detected_fields', function (
            Blueprint $table
        ) {

            $table->id();

            $table->foreignId('source_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('field_name');

            $table->string('data_type')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'source_id',
                'field_name'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'source_detected_fields'
        );
    }
};