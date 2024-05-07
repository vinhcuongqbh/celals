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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('post_title');
            $table->text('post_content')->nullable();
            $table->string('post_img')->nullable();
            $table->tinyInteger('post_catalogue_id');
            $table->tinyInteger('post_author_id');
            $table->integer('post_priority')->nullable();           
            $table->tinyInteger('post_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
