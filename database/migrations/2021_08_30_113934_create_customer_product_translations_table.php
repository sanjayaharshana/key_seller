<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_product_id');
            $table->text('name')->nullable();
            $table->text('unit')->nullable();
            $table->text('description')->nullable();
            $table->text('lang');
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
        Schema::dropIfExists('customer_product_translations');
    }
}
