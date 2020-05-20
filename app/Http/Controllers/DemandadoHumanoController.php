<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\DemandadoHumano;
use LegalIS\ExpedienteCivil;

class DemandadoHumanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpedienteCivil $expedientecivil, Request $request)
    {
        if($request->ajax()) {
            return response()->json($expedientecivil->humanDefendant, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpedienteCivil $expedientecivil, Request $request)
    {
        if ($request->ajax()) {  
            $demandadohumano = new DemandadoHumano();
            $demandadohumano->apellido = $request->input("apellido");
            $demandadohumano->nombre = $request->input("nombre");
            $demandadohumano->cuit = $request->input("cuit");
            $demandadohumano->save();
            $demandadohumano->expediente_civils()->attach($expedientecivil);  
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Demandado creado correctamente.",
            "humanDefendant" => $demandadohumano,
            //"representanteLegal" => $representantelegal
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $id = $request->input("id");
            $demandadohumano = DemandadoHumano::where('id',$id)->first();
            $demandadohumano->apellido = $request->input("apellido");
            $demandadohumano->nombre = $request->input("nombre");
            $demandadohumano->cuit = $request->input("cuit");
            $demandadohumano->save();
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Demandado modificado correctamente.",
            "humanDefendant" => $demandadohumano
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpedienteCivil $expedientecivil, $id)
    {
        $demandadohumano = DemandadoHumano::where('id',$id)->first();
        $demandadohumano->expediente_civils()->detach($expedientecivil);
        DemandadoHumano::destroy($id);
        //return 'deleted';

        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor eliminado correctamente.",
            //"humanActor" => $actorhumano
        ], 200);
    }
}
