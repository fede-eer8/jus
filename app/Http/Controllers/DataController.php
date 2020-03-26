<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\Categoria;
use LegalIS\Materia;
use DB;

class DataController extends Controller
{
    public function getCategorias() {

        $categorias = DB::table('categorias')->pluck("cat_nombre","id");
        return view('expedientecivil.dropdown',compact('categorias'));
    }
    
    public function getMaterias($id) 
    {        
        $materias = DB::table("materias")->where("cat_id",$id)->pluck("mat_nombre","id");
        return json_encode($materias);
    }
}
