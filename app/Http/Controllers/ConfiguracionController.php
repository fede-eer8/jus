<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    public function index(Request $request) {
        if(Auth::check()){
            $request->user()->authorizeRoles('admin');
            //$expedienteCivils = ExpedienteCivil::all();
            //$categorias = Categoria::all();
            return view('configuracion.index');
        }
        else {
            return view('errors.401');
        }
    }
}
