<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\ExpedienteCivil;
use LegalIS\Categoria;
use Illuminate\Support\Facades\Auth;
//use LegalIS\User;

class ExpedienteCivilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            $request->user()->authorizeRoles('admin');
            $expedienteCivils = ExpedienteCivil::all();
            //$categorias = Categoria::all();
            return view('expedientecivil.index', compact('expedienteCivils'));
        }
        else {
            return view('errors.401');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all()->pluck("cat_nombre","id");
        return view('expedientecivil.create',compact('categorias'));
    }

    public function getMaterias($id) 
    {        
        $materias = DB::table("materias")->where("cat_id", $id)->pluck("mat_nombre","id");
        return json_encode($materias);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expedienteCivil = new ExpedienteCivil();

        $expedienteCivil->nombre = $request->input('nombre');
        $expedienteCivil->cat_id = $request->input('categoria');
        $expedienteCivil->mat_id = $request->input('materia');
        $expedienteCivil->slug = $expedienteCivil->nombre.$expedienteCivil->created_at;
        $expedienteCivil->save();

        return redirect()->route('expedientecivil.index'); 
        //return $request->all();
        //return $request->input('nombre');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExpedienteCivil $expedientecivil, Request $request)
    {
        // $expedienteCivil = ExpedienteCivil::where('slug', '=', $slug)->firstOrFail();
        if(Auth::check()){
            $request->user()->authorizeRoles('admin');
            return view('expedientecivil.show', compact('expedientecivil'));
        }
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpedienteCivil $expedientecivil)
    {
        //$actorhumano = ActorHumano::where('id',$id)->first();
            //$expedienteCivil->human_actors()->detach($id);
            $expedientecivil->delete();
            return redirect()->route('expedientecivil.index');

            // return response()->json([
            //     // "trainer" => $trainer,
            //     "message" => "Actor modificado correctamente.",
            //     "humanActor" => $actorhumano
            // ], 200);
    }
}
