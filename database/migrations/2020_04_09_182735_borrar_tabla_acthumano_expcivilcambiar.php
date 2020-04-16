<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BorrarTablaActhumanoExpcivilcambiar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('acthumano_expcivil', function (Blueprint $table) {
        //     $table->integer('expcivil_id')->unsigned();
        //     $table->integer('actorhumano_id')->unsigned();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acthumano_expcivil', function (Blueprint $table) {
            //
        });
    }
}
