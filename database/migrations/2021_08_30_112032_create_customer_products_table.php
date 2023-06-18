<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->integer('published')->default(0);
            $table->integer('status')->default(0);
            $table->text('added_by')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('subsubcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->text('photos')->nullable();
            $table->text('thumbnail_img')->nullable();
            $table->text('conditon')->nullable();
            $table->text('location')->nullable();
            $table->text('video_provider')->nullable();
            $table->text('video_link')->nullable();
            $table->text('unit')->nullable();
            $table->text('tags')->nullable();
            $table->text('description')->nullable();
            $table->double('unit_price',20,2)->nullable()->default(0.00);
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_img')->nullable();
            $table->text('pdf')->nullable();
            $table->text('slug')->nullable();
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
        Schema::dropIfExists('customer_products');
    }
}
