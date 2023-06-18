<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('level')->default(0);
            $table->text('name');
            $table->integer('order_level')->default(0);
            $table->double('commision_rate',8,2)->default(0.00);
            $table->text('banner')->nullable();
            $table->text('icon')->nullable();
            $table->integer('featured')->default(0);
            $table->integer('top')->default(0);
            $table->integer('digital')->default(0);
            $table->text('slug')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
