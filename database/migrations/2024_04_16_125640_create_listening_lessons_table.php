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
        Schema::create('listening_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_id')->unique();
            //$table->tinyInteger('level_id');
            $table->text('subject');
            $table->text('link_audio');
            $table->text('answer')->nullable();
            $table->text('link_answer')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listening_lessons');
    }
};
