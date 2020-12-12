<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annances', function (Blueprint $table) {
            $table->bigIncrements('numAnnance');
            $table->text('commentaire');
            $table->float('prix');
            $table->bigInteger('pieace_idPieace')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('voiture_idVoiture')->unsigned();
            $table->timestamps();

            $table->foreign('pieace_idPieace')
                ->references('idPieace')
                ->on('pieaces')
                ->onDelete('cascade');

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
        Schema::dropIfExists('annances');
    }
}