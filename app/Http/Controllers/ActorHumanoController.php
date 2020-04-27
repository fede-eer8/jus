<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\ActorHumano;
use LegalIS\ExpedienteCivil;
use LegalIS\RepresentanteLegal;
use LegalIS\Http\Resources\ActorHumano as ActorHumanoResource;

class ActorHumanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpedienteCivil $expedientecivil, Request $request)
    {
        if($request->ajax()) { //ExpedienteCivil $expedientecivil, Request $request
            return response()->json($expedientecivil->humanActors, 200);
        }
        // return view('actorhumano.index');
        //$expedientecivil = ExpedienteCivil::where('slug', $slug)->first();
        //$actorhumano = $expedientecivil->humanActors()->orderBy('created_at', 'desc')->paginate(10);
        //return ActorHumanoResource::collection(ActorHumano::orderBy('created_at', 'desc')->paginate(10));

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
        // $expCivil_actHumano = ExpedienteCivil::where('name','user')->first();
        // $role_admin = Role::where('name','admin')->first();

        // $actorhumano = ActorHumano::create($request->all());
        // return new ActorHumanoResource($actorhumano);

        //codigo al 21-04        ExpedienteCivil $expedientecivil, Request $request
        if ($request->ajax()) {  
            if($request->replegal_id != 0) {
                $representantelegal = RepresentanteLegal::where('id', $request->replegal_id)->first();
            }
            $actorhumano = new ActorHumano();
            $actorhumano->nombre = $request->input("nombre");
            $actorhumano->apellido = $request->input("apellido");
            $actorhumano->seudonimo = $request->input("seudonimo");
            $actorhumano->edad = $request->input("edadLegal");
            if($request->replegal_id == 0) {
                $actorhumano->replegal_id = $request->replegal_id; //si es mayor de edad o emancipado no tiene repLegal
                $actorhumano->save();
            }
            else {
                $actorhumano->representanteLegal()->associate($representantelegal)->save();
            }
            //
            //$actorhumano->save();
            $actorhumano->expediente_civils()->attach($expedientecivil);
            
            
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor creado correctamente.",
            "humanActor" => $actorhumano,
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
        // $actorhumano = ActorHumano::find($id);
        // return new ActorHumanoResource($actorhumano);
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
        // $actorhumano = ActorHumano::find($id);
        // $actorhumano->update($request->all());
        // return new ActorHumanoResource($actorhumano);


        //$actorhumano = where('id',5);

        //codigo al 21-04   Request $request
        if ($request->ajax()) {
            $id = $request->input("id");
            $actorhumano = ActorHumano::where('id',$id)->first();
            $actorhumano->nombre = $request->input("nombre");
            $actorhumano->apellido = $request->input("apellido");
            $actorhumano->seudonimo = $request->input("seudonimo");
            $actorhumano->save();
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Actor modificado correctamente.",
            "humanActor" => $actorhumano
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
        // $actorhumano = ActorHumano::find($id);
        // $actorhumano->delete();
        // return new ActorHumanoResource($actorhumano);  
            // codigo al 21-04 ExpedienteCivil $expedientecivil, $id
            $actorhumano = ActorHumano::where('id',$id)->first();
            $actorhumano->representanteLegal()->dissociate();
            $actorhumano->expediente_civils()->detach($expedientecivil);
            ActorHumano::destroy($id);
            //return 'deleted';

            return response()->json([
                // "trainer" => $trainer,
                "message" => "Actor eliminado correctamente.",
                //"humanActor" => $actorhumano
            ], 200);
        
    }
    // public function delete(ExpedienteCivil $expedientecivil, $id)
    // {
    //         $actorhumano = ActorHumano::where('id',$id)->first();
    //         $actorhumano->expediente_civils()->detach($id);
    //         ActorHumano::destroy($id);
    //         //return 'deleted';

    //         return response()->json([
    //             // "trainer" => $trainer,
    //             "message" => "Actor modificado correctamente.",
    //             "humanActor" => $actorhumano
    //         ], 200);

            
        
    // }
}
