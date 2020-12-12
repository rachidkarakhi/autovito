<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagecs', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('nameImage');
          $table->bigInteger('annoncecs_id')->unsigned();
          $table->timestamps();

          $table->foreign('annoncecs_id')
              ->references('id')
              ->on('annoncecs')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagecs');
    }
}
