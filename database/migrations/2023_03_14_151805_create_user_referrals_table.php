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
            $table->string('parent_name')->nullable();
            $table->string('child_age')->nullable();
            $table->string('email')->nullable();
            $table->string('tel');
            $table->string('center_id')->nullable();
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
