<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\ExpedienteCivil;
use LegalIS\ActorIdeal;

class ActorIdealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpedienteCivil $expedientecivil, Request $request)
    {
        if($request->ajax()) {
            return response()->json($expedientecivil->idealActors, 200);
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

            $actorideal = new ActorIdeal();
            $actorideal->razon_soc = $request->input("razonSocial");
            $actorideal->cuit = $request->input("cuit");
            $actorideal->domicilio = $request->input("domicilio");
            $actorideal->save();
            $actorideal->expediente_civils()->attach($expedientecivil);  
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor creado correctamente.",
            "idealActor" => $actorideal,
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
            $actorideal = ActorIdeal::where('id',$id)->first();
            $actorideal->razon_soc = $request->input("razonSocial");
            $actorideal->cuit = $request->input("cuit");
            $actorideal->domicilio = $request->input("domicilio");
            $actorideal->save();
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor modificado correctamente.",
            "idealActor" => $actorideal
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
        $actorideal = ActorIdeal::where('id',$id)->first();
        $actorideal->expediente_civils()->detach($expedientecivil);
        ActorIdeal::destroy($id);
        //return 'deleted';

        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor eliminado correctamente.",
            //"humanActor" => $actorhumano
        ], 200);
    }
}
