<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActhumanoExpcivil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('acthumano_expcivil', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('expcivil_id')->unsigned();
        //     $table->integer('actorhumano_id')->unsigned();
        //     $table->timestamps();
        // });
        Schema::create('acthumano_expcivil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expcivil_id')->unsigned();
            $table->integer('acthumano_id')->unsigned();
            $table->foreign('expcivil_id')->references('id')->on('expediente_civils')->onDelete('cascade');
            $table->foreign('acthumano_id')->references('id')->on('actor_humanos')->onDelete('cascade');
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
        Schema::dropIfExists('acthumano_expcivil');
    }
}
