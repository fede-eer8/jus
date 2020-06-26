<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\Categoria;
use LegalIS\Materia;
use LegalIS\TipoDocumento;


class APIController extends Controller
{
    public function getCategorias() {
        $data = Categoria::get();
        return response()->json($data);
    }

    public function getMaterias(Request $request) {
        $data = Materia::where('cat_id', $request->cat_id)->get();
        return response()->json($data);
    }

    public function getTipoDocumento() {

        $data = TipoDocumento::get();
        return response()->json($data);


    }
}
