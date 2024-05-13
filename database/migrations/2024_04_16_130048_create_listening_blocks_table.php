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
        Schema::create('listening_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('block_id')->unique();
            $table->tinyInteger('level_id');
            $table->text('block_name');
            $table->text('question_list');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listening_blocks');
    }
};
