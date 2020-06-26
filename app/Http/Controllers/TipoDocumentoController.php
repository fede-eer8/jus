<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\TipoDocumento;

class TipoDocumentoController extends Controller
{
    public function index() {
        $data = TipoDocumento::get();
        return response()->json($data, 200);
    }

    public function store() {

    }

    public function destroy() {

    }

}
