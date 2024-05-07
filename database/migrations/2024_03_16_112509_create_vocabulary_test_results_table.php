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
        Schema::create('vocabulary_test_results', function (Blueprint $table) {
            $table->id();
            $table->string('test_id');
            $table->string('test_answer_id');
            $table->string('name');
            $table->tinyInteger('age')->nullable();
            $table->string('tel');
            $table->tinyInteger('total_question');
            $table->tinyInteger('right_answer');
            $table->boolean('pass');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabulary_test_results');
    }
};
