<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('author_name');
            $table->text('description')->nullable();
            $table->text('social_links')->nullable();
            $table->text('profile_picture')->nullable();
            $table->text('cover_photo')->nullable();
            $table->text('story')->nullable();
            $table->text('slogan')->nullable();
            $table->text('slugs')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('likes')->nullable();
            $table->text('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_details');
    }
}
