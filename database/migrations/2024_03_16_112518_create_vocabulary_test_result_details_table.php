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
        Schema::create('vocabulary_test_result_details', function (Blueprint $table) {
            $table->id();
            $table->string('test_answer_id');
            $table->string('word_id');
            $table->string('word_meaning');
            $table->string('word');
            $table->tinyInteger('point');
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabulary_test_result_details');
    }
};
