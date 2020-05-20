<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\DemandadoIdeal;
use LegalIS\ExpedienteCivil;

class DemandadoIdealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpedienteCivil $expedientecivil, Request $request)
    {
        if($request->ajax()) {
            return response()->json($expedientecivil->idealDefendant, 200);
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
            $demandadoideal = new DemandadoIdeal();
            $demandadoideal->razon_soc = $request->input("razon_soc");
            $demandadoideal->cuit = $request->input("cuit");
            $demandadoideal->domicilio = $request->input("domicilio");
            $demandadoideal->save();
            $demandadoideal->expediente_civils()->attach($expedientecivil);  
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Demandado creado correctamente.",
            "idealDefendant" => $demandadoideal,
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
            $demandadoideal = DemandadoIdeal::where('id',$id)->first();
            $demandadoideal->razon_soc = $request->input("razon_soc");
            $demandadoideal->cuit = $request->input("cuit");
            $demandadoideal->domicilio = $request->input("domicilio");
            $demandadoideal->save();
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Demandado modificado correctamente.",
            "idealDefendant" => $demandadoideal
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
        $demandadoideal = DemandadoIdeal::where('id',$id)->first();
        $demandadoideal->expediente_civils()->detach($expedientecivil);
        DemandadoIdeal::destroy($id);
        //return 'deleted';

        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor eliminado correctamente.",
            //"humanActor" => $actorhumano
        ], 200);
    }
}
