<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieaces', function (Blueprint $table) {
            $table->bigIncrements('idPieace');
            $table->string('desPieace');
            $table->bigInteger('sousCategorie_idSousCat')->unsigned();
            $table->timestamps();

            $table->foreign('sousCategorie_idSousCat')
                ->references('idSousCat')
                ->on('sousCategories')
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
        Schema::dropIfExists('pieaces');
    }
}