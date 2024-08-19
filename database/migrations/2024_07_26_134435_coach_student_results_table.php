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
        Schema::create('coach_student_results', function (Blueprint $table) {
            $table->id();
            $table->text('student_id');
            $table->integer('question_id');
            $table->tinyInteger('coach_type_id');
            $table->text('teacher_id')->nullable();
            $table->float('point', 8, 2)->nullable();
            $table->string('pass')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coach_student_results');
    }
};
