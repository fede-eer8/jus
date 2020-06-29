<?php

namespace LegalIS\Http\Controllers;

use Illuminate\Http\Request;
use LegalIS\ExpedienteCivil;
use LegalIS\Documento;
use LegalIS\TipoDocumento;

class DocumentoController extends Controller
{
    public function index(ExpedienteCivil $expedientecivil, Request $request)
    {
        if($request->ajax()) {
            return response()->json($expedientecivil->documento, 200);
        }
    }
    
    public function store(ExpedienteCivil $expedientecivil, Request $request)
    {
        // return $request;
        if ($request->ajax()) {  

            $documento = new Documento();
            if($request->hasFile($request->file('name'))) {
                $file = $request->file;
                $typedoc = TipoDocumento::where('nombre', $request->type)->first();
                // $name = date('Ymd_His').'_'.$file->getClientOriginalName();
                $name = time().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/storage/expcivil/'. $expedientecivil->nombre .'/'.$typedoc->slug_fd.'/', $name);
            }
            $documento->nombre = $name;
            $documento->tipo_documento()->associate($typedoc)->expediente_civils()->associate($expedientecivil)->save();
            
            //$documento->save();
            //$documento->expediente_civils()->attach($expedientecivil);  
        }
        return response()->json([
            // "trainer" => $trainer,
            "message" => "Documento creado correctamente.",
            "documento" => $documento,
            //"representanteLegal" => $representantelegal
        ], 200);
    }

    public function show(ExpedienteCivil $expedientecivil, Request $request, $id)
    {
        $filename = Documento::where('id', $id)->first();
        $filetype = TipoDocumento::where('id', $filename->tipodoc_id)->first();
        
        if($request->ajax()) {
            $file = public_path() . "/storage/expcivil/".$expedientecivil->nombre.'/'.$filetype->slug_fd.'/'.$filename->nombre;
            // $name = substr ( $filename->nombre , 11 );
            // $file->rename($file, $name);
            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            return response()->file($file);
            // return response()->download($file, $filename, $headers);
            
            // return response()->json([
            //     // "trainer" => $trainer,
            //     "message" => "Representante ubicado correctamente.",
            //     //"humanActor" => $actorhumano,
            //     "representanteLegal" => $representantelegal,
            //     "id" => $representantelegal->id
    
            // ], 200);
        }    
    }
}
