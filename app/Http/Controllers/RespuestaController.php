<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        
    }
    public function indexHome()
    {  
        //TODO con consulta validar si ya se respondió el checklist de acuerdo a la fecha
        try{
            $date = Carbon::now(); 
            $mes = $date->formatLocalized('%B');
            $weekday = $date->dayOfWeek;// Se obtiene el numero de la semana y si es domingo o sabado no lista el checklist
            $day = new ValidateDay(); // Clase para operar y saber los dias habiles y ni habiles
            if(auth()->user()->roles->id == 1){ // Si rol igual a Coordinador operaciones le lista todo
                $checklists = Checklist::all(); 
            }elseif(auth()->user()->roles->id == 2){ // Si rol igual a Coordinador zona le lista tipo coordinador zona o ambos
                $checklists = Checklist::where('tipo_id',1)->orWhere('tipo_id',3)->get(); 
            }elseif(auth()->user()->roles->id == 3){ // Si rol igual a anfitrion le lista tipo anfitrion
                $checklists = Checklist::where('tipo_id',2)->orWhere('tipo_id',3)->get(); 
            }
            $arrayChecklists = array();// Se agrega un array si cumple la condicion y se manda a la vista
            $fechaActual = $date->format('Y-m-d'); // Obtengo el dia actual año mes dia
            // Lista todos los cheklist y compara y si corresponde a cada 
            for($i=0;$i<count($checklists);$i++){
               
                if($checklists[$i]->frecuencias->Nombre == "Bimestral"
                    && $day->bimonthly($fechaActual) && $day->isHoliday($fechaActual)
                    && $day->dayNotEnabled($weekday)&& $day->btnActive($checklists[$i]->id)){
                       
                        array_push($arrayChecklists, $checklists[$i]);
                }elseif($checklists[$i]->frecuencias->Nombre == "Semestral"
                    && $day->biannual($fechaActual) && $day->isHoliday($fechaActual)
                    && $day->dayNotEnabled($weekday)&& $day->btnActive($checklists[$i]->id)){

                      array_push($arrayChecklists, $checklists[$i]);
                }elseif(($checklists[$i]->frecuencias->Fecha_inicial <= $fechaActual 
                    && $checklists[$i]->id != 1   
                    && $checklists[$i]->frecuencias->Fecha_final >= $fechaActual) 
                    && $day->isHoliday($fechaActual)&& $day->dayNotEnabled($weekday) 
                    && $day->btnActive($checklists[$i]->id,$fechaActual)
                    && $day->btnActive($checklists[$i]->id)){

                      array_push($arrayChecklists, $checklists[$i]);
                }
            }
            $checkPendientes=count($arrayChecklists);//Solo cuenta los checklist faltantes y manda la cantidad a la vista
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
        // y compara la tabla respuestas co la tabla preguntas y si el id pregunta no corresponde con el id pregunata
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
             if($request->input('respuesta') == "on"){
                $respuesta->respuesta = true;
             }else{
                $respuesta->respuesta = false;
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

     public function show($id)
     {
        $pregunta = Pregunta::find($id);
        return View('respuestas.show', compact('pregunta'));
     }

}
