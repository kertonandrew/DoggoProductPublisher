<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_product_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dog_product_id');
            $table->string('option1');
            $table->string('price');
            $table->string('sku');
            $table->timestamps();

            $table->foreign('dog_product_id')->references('id')->on('dog_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dog_product_variants');
    }
}
