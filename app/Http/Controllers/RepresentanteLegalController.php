<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\RepresentanteLegal;
use LegalIS\ExpedienteCivil;

class RepresentanteLegalController extends Controller
{
    public function show(ExpedienteCivil $expedientecivil, Request $request, $id)
    {
        if($request->ajax() && $id != 0) {
            $representantelegal = RepresentanteLegal::where('id', $id)->first();
            return response()->json([
                // "trainer" => $trainer,
                "message" => "Representante ubicado correctamente.",
                //"humanActor" => $actorhumano,
                "representanteLegal" => $representantelegal,
                "id" => $representantelegal->id
    
            ], 200);
        }    
    }

    public function store(ExpedienteCivil $expedientecivil, Request $request)
    {
        // $expCivil_actHumano = ExpedienteCivil::where('name','user')->first();
        // $role_admin = Role::where('name','admin')->first();

        if ($request->ajax()) {

            $representantelegal = new RepresentanteLegal();
            $representantelegal->nombre = $request->input("nombreRepLegal");
            $representantelegal->apellido = $request->input("apellidoRepLegal");
            $representantelegal->calidad = $request->input("calidadRepLegal");
            //$actorhumano->representanteLegal()->associate($actorhumano)->save();
            //$actorhumano->save();
            $representantelegal->save();
            //$actorhumano->save();
            //$actorhumano->expediente_civils()->attach($expedientecivil);
                  
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Representante creado correctamente.",
            //"humanActor" => $actorhumano,
            "representanteLegal" => $representantelegal,
            "id" => $representantelegal->id

        ], 200);
    }
}
