<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_breeds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('breedGroup_id')->nullable();
            $table->string('name');
            $table->string('imageUrl');
            $table->timestamps();
        });

        // Broke this out from Schema::create, not sure if the table needs to
        // be created first before referencing it.
        Schema::table('dog_breeds', function (Blueprint $table) {
            $table->foreign('breedGroup_id')->references('id')->on('dog_breeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dog_breeds');
    }
}
