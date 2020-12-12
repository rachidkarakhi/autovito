<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToAnnance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annances', function (Blueprint $table) {
            $table->string("telephone")->after('commentaire');
            $table->string("nom")->after('commentaire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('annances', function (Blueprint $table) {
            $table->dropColumn('telephone');
            $table->dropColumn('nom');
        });
    }
}