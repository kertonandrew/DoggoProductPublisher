<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dog_product_id');
            $table->string('src');
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
        Schema::dropIfExists('dog_product_images');
    }
}
