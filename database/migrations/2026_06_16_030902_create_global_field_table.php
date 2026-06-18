<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('global_fields', function (Blueprint $table) {

            $table->id();

            $table->string('code')
                ->unique();

            $table->string('name');

            $table->string('data_type')
                ->default('string');

            $table->boolean('is_searchable')
                ->default(true);

            $table->boolean('is_filterable')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'global_fields'
        );
    }
};