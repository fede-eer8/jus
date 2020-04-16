<?php

use Illuminate\Database\Seeder;
use LegalIS\Categoria;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Categoria();
        $category->cat_nombre = "De conocimiento";
        $category->save();
        
        $category = new Categoria();
        $category->cat_nombre = "De conocimiento especial";
        $category->save();

        $category = new Categoria();
        $category->cat_nombre = "Especial y autónomo";
        $category->save();
    }
}
