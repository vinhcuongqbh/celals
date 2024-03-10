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
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id('word_id');
            $table->tinyInteger('level_id');
            $table->tinyInteger('topic_id');
            $table->string('word');
            $table->tinyInteger('word_type_id')->nullable();
            $table->string('spelling')->nullable();
            $table->string('word_meaning');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabularies');
    }
};
