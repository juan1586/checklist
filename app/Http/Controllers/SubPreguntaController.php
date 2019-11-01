<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubPregunta;
use App\Pregunta;
use App\Http\Requests\storeSubPreguntaRequest;
use App\Http\Requests\UpdateSubPreguntaRequest;
use DB;

class SubPreguntaController extends Controller
{

    public function __construct()
    {
        // Aplica si es coordinador zona o admin zoneC
        $this->middleware('zoneC');
        $this->middleware('auth');
    }
    
    public function edit($id)
    {
        $subpregunta = SubPregunta::find($id);
        return View('subpreguntas.edit', compact('subpregunta'));
    }
    public function create($id)
    {
        $subpregunta = Pregunta::find($id);
        return View('subpreguntas.create', compact('subpregunta'));
    }

    public function store(storeSubPreguntaRequest $request)
    {
        try{
            DB::BeginTransaction();
            $subpregunta = new Subpregunta();
            $subpregunta->Nombre = $request->input('Nombre');
            $subpregunta->pregunta_id = $request->input('pregunta_id');
            $idPregunta= $request->input('pregunta_id');
            if($subpregunta->save()){
                DB::commit();
                return redirect()->route('pregunta.edit', $idPregunta )->with('info','Creado con exito'); 
            }
        DB::rollback();
        return back()->with('error', 'Error al crear');
        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
        
    }
    public function update(UpdateSubPreguntaRequest $request, $id)
    {
        try{
            DB::BeginTransaction();
            $subpregunta = SubPregunta::find($id);
            $subpregunta->Nombre = $request->input('Nombre');          
            $idPregunta = $request->input('pregunta_id');
            if($subpregunta->save())
            {
                DB::commit();
                return back()->with('info', 'Editada con exito ');            }
            DB::rollback();
            return back()->with('error', 'Error al editar');

        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al editar '.$msg);
        }
    }
    public function destroy($id)
    {
        SubPregunta::find($id)->delete();
        return back()->with('info','Eliminado con exito'); 
    }
    
}
