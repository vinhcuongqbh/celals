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
            $table->text('user_id');            
            $table->Integer('question_id');           
            $table->float('point', 8, 2);
            $table->string('pass');
            $table->longText('result')->nullable();
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
