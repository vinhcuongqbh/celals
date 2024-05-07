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
        Schema::create('user_referrals', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->tinyInteger('advise_type_id');
            $table->string('student_name');
            $table->string('student_age')->nullable();
            $table->string('student_email')->nullable();
            $table->string('student_tel');
            $table->string('student_school')->nullable();
            $table->boolean('ref_status_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_referrals');
    }
};
