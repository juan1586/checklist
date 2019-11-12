<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ValidateChecklist;
use App\Pregunta;
use App\Respuesta;
use Carbon\Carbon;
use App\Checklist;
use Exception;
use DB;
use App\Services\ValidateDay;

class RespuestaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isGuest'); 
    }
    public function indexHome()
    {  
        //Funcio de consulta de checklist refactorizada
        $checkPendientes = new ValidateChecklist();
       
        //TODO con consulta validar si ya se respondió el checklist de acuerdo a la fecha
        try{
            $arrayChecklists = $checkPendientes->cantidadChecklist();// Esta funcion me trae los check pendientes
            $checkPendientes = count($arrayChecklists);//Solo cuenta los checklist faltantes y manda la cantidad a la vista
            return View('respuestas.homeRespuestas', compact('arrayChecklists','checkPendientes')); 
        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error '.$msg);
        }     
    }
 

    public function getCheck($id)
    {
        $date = Carbon::now(); 
        $fechaActual = $date->format('Y-m-d'); 
        $usuarioActualId = auth()->user()->id;
        
        // Esta consulta primero evalua que las preguntas del dia no se hallan contestado aun
        // y compara la tabla respuestas con la tabla preguntas y si el id pregunta no corresponde con el id pregunta
        // de la tabla respuestas la lista claro esta evaluando la fecha

        $preguntas = Pregunta::select('id','Nombre','descripcion','id_checklist')
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('respuestas')
                ->whereRaw('preguntas.id = respuestas.id_pregunta')
                ->whereRaw('respuestas.fecha=(select CURDATE())')
                ->where('id_usuario', auth()->user()->id);
        })->where('id_checklist',$id)->paginate(40);
     
        return View('respuestas.index', compact('preguntas'));

    }

    public function store(Request $request)
    {
        try
        {
            $date = Carbon::now();
            $hora = $date->format('h:i:s');
            $fecha = $date->format('Y-m-d');
            //Esta opcion guarda formato array
            // for ($i=0; $i < sizeof($request->id_pregunta); $i++) { 
            //     $respuesta = new Respuesta();
            //     $respuesta->id_pregunta = $request->id_pregunta[$i]; 
            //     $respuesta->id_usuario = $request->id_usuario[$i];    
            //     $respuesta->id_checklist = $request->id_checklist[$i]; 
            //     if(sizeof($request->respuesta)> $i)
            //     {
            //         //ojo poner la pocision que coincida con el id de la pregunat
            //         $respuesta->respuesta = $request->respuesta[$i];
            //     }
            //     $respuesta->hora = $hora;
            //     $respuesta->fecha = $fecha; 
            //     $respuesta->save(); 
            // }
            DB::BeginTransaction();
            $respuesta = new Respuesta();

            // Validación de las sub preguntas
            if($request->input('subRespuesta') != null){
                if(count($request->input('subRespuesta')) == $request->input('contSub')){
                    $respuesta->respuesta = true;
                }else{
                    $respuesta->respuesta = false;
                }            
            }elseif($request->input('subRespuesta') == null && $request->input('contSub') > 0){
                $respuesta->respuesta = false;
            }elseif($request->input('subRespuesta') == null && $request->input('contSub') == 0){
                $respuesta->respuesta = true;
            }
    
            $respuesta->id_pregunta = $request->input('id_pregunta');          
            
            $respuesta->hora = $hora;
            $respuesta->fecha = $fecha;
            $respuesta->id_usuario = $request->input('id_usuario'); 
            $respuesta->id_checklist = $request->input('id_checklist');
        
            if($respuesta->save())
            {
                DB::commit();
                return back();
            }
            DB::rollback();
            
            return back()->with('error', 'Error al crear');
        } catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
     }

     // Metodo invocado desde preguntas
     public function show($id)
     {
        $pregunta = Pregunta::find($id);
        return View('respuestas.show', compact('pregunta'));
     }

}
