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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(false);
            $table->text('description')->nullable();
            $table->year('release_year')->nullable();
            $table->tinyInteger('language_id');
            $table->tinyInteger('original_language_id')->unsigned()->nullable();
            $table->tinyInteger('rental_duration')->unsigned()->default(3);
            $table->decimal('rental_rate', 4, 2)->default(4.99);
            $table->smallInteger('length')->unsigned()->nullable();
            $table->decimal('replacement_cost', 5, 2)->default(19.99);
            $table->enum('rating', ['G', 'PG', 'PG-13', 'R', 'NC-17'])->default('G');
            $table->json('special_features')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
