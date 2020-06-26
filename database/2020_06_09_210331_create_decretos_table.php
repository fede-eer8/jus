<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecretosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decretos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('expcivil_id')->unsigned();
            $table->foreign('expcivil_id')->references('id')->on('expediente_civils')->onDelete('cascade');
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
        Schema::dropIfExists('decretos');
    }
}
