<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActidealExpcivil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actideal_expcivil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expcivil_id')->unsigned();
            $table->integer('actideal_id')->unsigned();
            $table->foreign('expcivil_id')->references('id')->on('expediente_civils')->onDelete('cascade');
            $table->foreign('actideal_id')->references('id')->on('actor_ideals')->onDelete('cascade');
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
        Schema::dropIfExists('actideal_expcivil');
    }
}
