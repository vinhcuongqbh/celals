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
        Schema::create('student_practice_tests', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->tinyInteger('student_age');
            $table->string('student_tel');
            $table->string('public_test_id');
            $table->text('answer')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('point')->nullable();
            $table->string('teacher_id')->nullable();
            $table->date('date_comment')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_practice_tests');
    }
};
