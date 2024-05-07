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
        Schema::create('vocabulary_tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_id')->unique();
            $table->tinyInteger('level_id');
            $table->string('topic_id');
            $table->string('word_selected_id');
            $table->string('creator_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabulary_tests');
    }
};
