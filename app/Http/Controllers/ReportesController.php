<?php

namespace App\Http\Controllers;
use Khill\Lavacharts\Lavacharts;
use App\Respuesta;
use App\User;
use App\Pregunta;
use App\Checklist;
use App\Services\Reporte;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('zoneC');
        
    }
   // Este es reportes tiedas por fecha
    public function index(Request $request)
    { 
        //Clase que hace la validación de reportes es propia
        $reportesTiendas = new Reporte();
     
        
        // Usuarios o tiendas que van a la vista al select
        if(auth()->user()->roles->id != 1){ // Rol coordinador de zona, solo le manda sus anfitriones
            $users = User::where('parent_id',auth()->user()->id)->pluck('name','id');

        }else{
            //Si el rol es coordinador de operaciones, van todos, el diferente de uno es para no ir ellos mismos
            $users = User::where('id_rol','!=',1)->pluck('name','id');
        }

        //Filtrado de reportes
        // Esta función trae los checklist segun el usuarios
        $checklist = $reportesTiendas->checklist($request);
        // Esta función hace toda la validación de respuestas
        $reportes = $reportesTiendas->respuestas($request);
        return View('reportes.index', compact('checklist','reportes','users','dato'));
    }
    // Reportes tipo torta para las tiendas
    public function reporteTiendas(Request $request)
    { 
        $desde = trim($request->get('fecha_desde'));
        $hasta = trim($request->get('fecha_hasta'));
        if($desde == Null){
            $desde = "2000-11-20";
        }
        if($hasta == Null){
            $hasta = "2020-11-20";
        } 
        //Clase que hace la validación de reportes es propia
        $reportesTiendas = new Reporte();
        // Id check
        $check = $request->input('checklist_id');  
        // Id de la tienda o usuario     
        $id = $request->input('tienda_id');
      
        
        // Esta función trae los checklist segun el usuarios
        $checklist = $reportesTiendas->checklist($request);
        // Usuarios o tiendas que van a la vista al select
        if(auth()->user()->roles->id != 1){ // Rol coordinador de zona, solo le manda sus anfitriones
            $users = User::where('parent_id',auth()->user()->id)->pluck('name','id');
            
        }else{
            $users = User::where('id_rol','!=',1)->pluck('name','id');
        }
        
        
        // Variables para el lava charts para mostrar el usuario y check
        $checklistMsg = Checklist::find($check);
        $user = User::where('id',$id)->pluck('name');
        
       // Validar preguntas respondidas con las que faltan por responder
        $totalPreguntasPorChecklist = Pregunta::where('id_checklist',$check)->get();
        $totalPreguntasPorChecklistRespondidas = Respuesta::where('id_checklist',$check)
        ->where('id_usuario',$id)->where('fecha',$request->input('fecha_desde'))->get();
  
        
        $respuestaNo = Respuesta::where('respuesta',0)->where('id_usuario',$id)
        ->where('id_checklist',$check)
        ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')->get();
        $respuestaSi = Respuesta::where('respuesta',1)->where('id_usuario',$id)->where('id_checklist',$check)
        ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')->get();
       
        $lava = new Lavacharts; //Se instancia la clase para los informes
      
        //Valida la cantidad de preguntas respondidas con si y con no
        $respuestas = $lava->DataTable();
        $respuestas->addStringColumn('Reasons')
        ->addNumberColumn('Percent')
        ->addRow(['Respondidas si', count($respuestaSi) ])
        ->addRow(['Respondidas no',count($respuestaNo) ]);
            
    
        //Total preguntas
        $totalP= count($totalPreguntasPorChecklist);
        $respondidas=count($totalPreguntasPorChecklistRespondidas);
        $faltaResponder= $totalP-$respondidas;
        
        // Valida total preguntas con las q faltan por responder
        $preguntasYrespuestas = $lava->DataTable();
        $preguntasYrespuestas->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Cantidad preguntas',$totalP])
            ->addRow(['Cantidad sin responder',$faltaResponder]);
        // Guarda este string si no hay tienda por request o check
        $usuario = "Sin resultados";
        $msgCheck = "Sin resultados";

        if(count($user) > 0){
            $usuario = $user[0];// Si hay tienda en la consulta le da valor y la manda a la vista reportes
        }
        // Solo para pasar la variable del checklist a la vista
        if($checklistMsg != Null){
            $msgCheck = $checklistMsg->Nombre;
        }
        $lava->DonutChart('consulta1', $respuestas, [
            'title' => 'Tienda: '.$usuario." \n Desde:".$desde. " hasta: ".$hasta,
        ]);    
        $lava->DonutChart('consulta2', $preguntasYrespuestas, [
            'title' => 'Checklist: '.$msgCheck." \n fecha ".$desde
        ]);
    
        return view('reportes.reporteTiendas', compact('lava','users','checklist'));
        
    }
    public function show($id)
    {
        $reporte = Respuesta::find($id);
        return view('reportes.show',compact('reporte'));
    }

    public function retailerIndex(Request $request)
    {
        //Clase que hace la validación de reportes es propia
        $reportesTiendas = new Reporte();

        if(auth()->user()->roles->id != 1){
            $users = User::where('id',auth()->user()->id)->pluck('name','id');
        }else{
            $users = User::where('id_rol',2)->pluck('name','id');// Solo el id del CZ
        }
        // Funcion que me trae las respuestas de los retailers segun tienda 
        $reportes = $reportesTiendas->respuestasChecklistAuditorRetailer($request);
        return view('reportes.retailersIndex',compact('users','reportes'));
    }

    public function retailerShow($id)
    {
        $reporte = Respuesta::find($id);
        return view('reportes.retailersShow',compact('reporte'));
    }
}
