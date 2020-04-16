<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditarTablaAct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('acthumano_expcivil', function (Blueprint $table) {
        //     $table->foreign('expcivil_id')->references('id')->on('expediente_civils')->onDelete('cascade');
        //     $table->foreign('acthumano_id')->references('id')->on('actor_humanos')->onDelete('cascade');
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
