<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDemandadohumanoExpcivil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandadohumano_expcivil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expcivil_id')->unsigned();
            $table->integer('demandadohumano_id')->unsigned();
            $table->foreign('expcivil_id')->references('id')->on('expediente_civils')->onDelete('cascade');
            $table->foreign('demandadohumano_id')->references('id')->on('demandado_humanos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandadohumano_expcivil');
    }
}
