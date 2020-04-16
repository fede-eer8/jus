<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToExpedienteCivil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expediente_civils', function (Blueprint $table) {
            $table->string('slug')->unique();
            $table->timestamps(); //crea los campos de crated-at y updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_civils', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
