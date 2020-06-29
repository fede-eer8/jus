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

        $data = TipoDocumento::all();
        return response()->json($data);
    }

    public function store(Request $request) {
       
        if ($request->ajax()) {  

            $tipodoc = new TipoDocumento();
            $tipodoc->nombre = $request->input("name");
            $tipodoc->slug_fd = $request->input("slug");

            $tipodoc->save();     
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Tipo Documento creado correctamente.",
            "docType" => $tipodoc,
            //"representanteLegal" => $representantelegal
        ], 200);
    }

    public function update(Request $request, $id) {
        if ($request->ajax()) {
            $id = $request->input("id");
            $tipodoc = TipoDocumento::where('id',$id)->first();
            $tipodoc->nombre = $request->input("name");
            $tipodoc->slug_fd = $request->input("slug");
            $tipodoc->save();
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor modificado correctamente.",
            "docType" => $tipodoc
        ], 200);
    }

    public function destroy(Request $request, $id) {
        if ($request->ajax()) {
            //$id = $request->input("id");
            $tipodoc = TipoDocumento::where('id',$id)->first();
            TipoDocumento::destroy($id);
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Tipo Documento eliminado correctamente.",
            "docType" => $tipodoc
        ], 200);
    }
}
