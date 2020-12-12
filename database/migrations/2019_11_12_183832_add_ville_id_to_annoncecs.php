<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVilleIdToAnnoncecs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annoncecs', function (Blueprint $table) {

          $table->bigInteger('ville_idVille')->unsigned();

          $table->foreign('ville_idVille')
              ->references('idVille')
              ->on('villes')
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
        Schema::table('annoncecs', function (Blueprint $table) {
            //
        });
    }
}
