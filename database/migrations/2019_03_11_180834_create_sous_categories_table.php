<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sousCategories', function (Blueprint $table) {
            $table->bigIncrements('idSousCat');
            $table->string('desSousCat');
            $table->bigInteger('catigorie_idCat')->unsigned();
            $table->timestamps();

            $table->foreign('catigorie_idCat')
                ->references('idCat')
                ->on('catigories')
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
        Schema::dropIfExists('sousCategories');
    }
}