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
        Schema::create('listening_tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_id')->unique();
            $table->text('subject');
            $table->tinyInteger('test_type_id');
            $table->text('test_form')->nullable();
            $table->tinyInteger('test_duration')->nullable();
            $table->text('question')->nullable();
            $table->text('link_question')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listening_tests');
    }
};
