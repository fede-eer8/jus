<?php

use Illuminate\Database\Seeder;
use LegalIS\Materia;

class MateriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materia = new Materia();
        $materia->cat_id = 1;
        $materia->mat_nombre = "Acción de nulidad";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 1;
        $materia->mat_nombre = "Acción declarativa";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 1;
        $materia->mat_nombre = "Acción reales";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 2;
        $materia->mat_nombre = "Acciones posesorias y de tenencia";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 2;
        $materia->mat_nombre = "De conocimiento especial";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 2;
        $materia->mat_nombre = "División de bienes comunes";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 3;
        $materia->mat_nombre = "Árbitros";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 3;
        $materia->mat_nombre = "Autorización";
        $materia->save();

        $materia = new Materia();
        $materia->cat_id = 3;
        $materia->mat_nombre = "Cancelación de documentos";
        $materia->save();
    }
}
