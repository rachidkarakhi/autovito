<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnoncecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annoncecs', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('descMin');
          $table->text('descMax');
          $table->decimal('prix',6, 2);
          $table->string("telephone");
          $table->string("nom");
          $table->string('approve')->default('non');
          $table->bigInteger('user_id')->unsigned();
          $table->bigInteger('voiture_idVoiture')->unsigned();
          $table->timestamps();

          $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

          $table->foreign('voiture_idVoiture')
              ->references('idVoiture')
              ->on('voitures')
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
        Schema::dropIfExists('annoncecs');
    }
}
