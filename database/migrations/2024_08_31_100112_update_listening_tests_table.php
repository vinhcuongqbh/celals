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
        Schema::table('listening_tests', function (Blueprint $table) {          
            $table->longText('suggested_answer')->nullable()->after('question');
            $table->dropColumn('link_question');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listening_tests', function (Blueprint $table) {
            $table->dropColumn('suggested_answer');
            $table->text('link_question')->nullable();
        });
    }
};
