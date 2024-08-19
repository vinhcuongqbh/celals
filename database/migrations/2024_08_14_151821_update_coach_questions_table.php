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
        Schema::table('coach_questions', function (Blueprint $table) {          
            $table->renameColumn('coach_type', 'coach_type_id');
            $table->renameColumn('coach_subject', 'coach_subject_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coach_questions', function (Blueprint $table) {          
            $table->renameColumn('coach_type_id', 'coach_type');
            $table->renameColumn('coach_subject_id', 'coach_subject');
        });
    }
};
