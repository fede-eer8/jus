<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\ExpedienteCivil;
use LegalIS\Decreto;


class DecretoController extends Controller
{
    public function index(ExpedienteCivil $expedientecivil, Request $request)
    {
        if($request->ajax()) {
            return response()->json($expedientecivil->decreto, 200);
        }
    }
    
    public function store(ExpedienteCivil $expedientecivil, Request $request)
    {
        // return $request;
        if ($request->ajax()) {  

            $decreto = new Decreto();
            if($request->hasFile($request->file('name'))) {
                $file = $request->file;
                $name = date('Ymd_His').'_'.$file->getClientOriginalName();
                $file->move(public_path().'/expcivil/'. $expedientecivil->nombre .'/decretos/', $name);
            }
            $decreto->nombre = $name;
            $decreto->expediente_civils()->associate($expedientecivil)->save();
            //$decreto->save();
            //$decreto->expediente_civils()->attach($expedientecivil);  
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Decreto creado correctamente.",
            "decreto" => $decreto,
            //"representanteLegal" => $representantelegal
        ], 200);
    }
}
