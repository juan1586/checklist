<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storePreguntaRequest;
use App\Http\Requests\updatePreguntaRequest;
use App\Pregunta;
use App\SubPregunta;
use App\Checklist;
use Exception;
use DB;

class PreguntaController extends Controller
{
    public function __construct()
    {
        // Aplica si es coordinador zona o admin zoneC
        $this->middleware('zoneC');
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->roles->id != 1){
            $preguntas = Pregunta::where('user_id',auth()->user()->id)->orderBy('id','desc')->paginate(5);
        }else{            
            $preguntas = Pregunta::orderBy('id','desc')->paginate(5);
        }
       
        return View('preguntas.index',compact('preguntas'));
    }
 
    public function create()
    {
        if(auth()->user()->roles->id != 1){
            
            $checklists =  Checklist::where('id_usuario',auth()->user()->id)->orWhere('id',1)->pluck('Nombre','id');
        }else{
            $checklists =  Checklist::orderBy('id','desc')->pluck('Nombre','id');

        }
        return View('preguntas.create', compact('checklists'));
    }

    public function store(storePreguntaRequest $request ,Pregunta $pregunta)
    {
        try{
            
            DB::BeginTransaction();
            $pregunta = new Pregunta();
            $pregunta->Nombre = $request->input('Nombre');     
            $pregunta->descripcion = $request->input('descripcion');       
            $pregunta->id_checklist = $request->input('id_checklist');
            $pregunta->user_id = auth()->user()->id;
          
            if($pregunta->save())
            {
                DB::commit();
                return redirect()->route('pregunta.index')->with('info','creado con exito'); 
            }
            DB::rollback();
            return back()->with('error', 'Error al crear');

        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }

    public function edit($id)
    {
           
        $checklists = Checklist::pluck('Nombre','id');
        $pregunta = pregunta::find($id);
        
        return View('preguntas.edit', compact('checklists','pregunta'));
        
    }

    public function update(updatePreguntaRequest $request, $id)
    {
        try{
            
            DB::BeginTransaction();
            $pregunta = Pregunta::find($id);
            $pregunta->Nombre = $request->input('Nombre');  
            $pregunta->descripcion = $request->input('descripcion');          
            $pregunta->id_checklist = $request->input('id_checklist');
            
            if($pregunta->save())
            {
                DB::commit();
                return redirect()->route('pregunta.index')->with('info','Editado con exito'); 
            }
            DB::rollback();
            return back()->with('error', 'Error al crear');

        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }
    public function show($id)
    {
        $pregunta = Pregunta::find($id);
        $subpreguntas = SubPregunta::where('pregunta_id',$id)->paginate(50);
        return View('preguntas.show', compact('pregunta','subpreguntas'));
    }

    public function destroy($id)
    {
        $pregunta = Pregunta::find($id)->delete();
        return redirect()->route('pregunta.index')->with('info','Eliminado con exito'); 
    }
}
