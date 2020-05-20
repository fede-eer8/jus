<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDemandadoidealExpcivil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandadoideal_expcivil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expcivil_id')->unsigned();
            $table->integer('demandadoideal_id')->unsigned();
            $table->foreign('expcivil_id')->references('id')->on('expediente_civils')->onDelete('cascade');
            $table->foreign('demandadoideal_id')->references('id')->on('demandado_ideals')->onDelete('cascade');
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
        Schema::dropIfExists('demandadoideal_expcivil');
    }
}
