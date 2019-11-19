<?php

namespace App\Http\Controllers;
use Khill\Lavacharts\Lavacharts;
use App\Respuesta;
use App\User;
use App\Pregunta;
use App\Checklist;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('zoneC');
    }

    public function index(Request $request)
    {
        // Nos llevamos los usuarios o tiendas que son lo que responden Checklist.
        $tiendas = User::where('id','!=',1)->pluck('name','id');
        // Si todos los campos vienen definidos hace la busqueda si no envia todos.
        if($request->input('fecha_desde') != null and $request->input('fecha_hasta') != null and $request->input('tienda') != null){
            $reportes = Respuesta::where('id_usuario',$request->input('tienda'))
            ->whereRaw('fecha >="'.$request->input('fecha_desde').'" and fecha <="'.$request->input('fecha_hasta').'"')
            ->orderBy('id','DESC')
            ->paginate(10);
        }else{ 
            $reportes = Respuesta::where('id_usuario','!=',1)
            ->orderBy('id','DESC')->paginate(10);            
        }
        return View('reportes.index', compact('tiendas','reportes'));
    }

    public function reporteTiendas(Request $request)
    { 
       
        // Se inicializa variable
        $check = $request->input('checklist_id');
        $checklist = Checklist::where('rol_id',-1)->pluck('Nombre','id');
        $id = $request->input('tienda_id');// Id de la tienda o usuario
        $usuarioRequest = User::find($id); // Buscamos el usuario o tienda
        $checklistMsg = Checklist::find($check);// Se busca el checklist, solo para mandar a la vista
        // Valida que tenga valor la consulta
        if($usuarioRequest != NULL){            
            $usuarioAnfitrion=$usuarioRequest->parent; // Para saber si es un anfitrion

            // Esta parte me filtra los checklist q los CZ crearon para su anfitrion
            if($usuarioAnfitrion != Null  ){
                // Saca el id del CZ al que pertenece el anfitrion
                $usuarioAnfitrion->id;
                $checklist = Checklist::where('id_usuario', $usuarioAnfitrion->id)
                ->orWhere('id_usuario',1)->where('tipo_id',2)->orWhere('tipo_id',3)
                ->pluck('Nombre','id');
            // Si es rol anfitrión y no pertenece a un CZ
            }elseif($usuarioRequest->id_rol == 3 && $usuarioAnfitrion == Null){                
                $checklist = Checklist::where('rol_id',-1)->pluck('Nombre','id');
            }else{            
                // Si 
                $checklist = Checklist::where('rol_id',1)->where('id','!=',1)
                ->where('tipo_id',[1,3])->pluck('Nombre','id');
            }
        }
        // Usuarios o tiendas que van a la vista al select
        if(auth()->user()->roles->id != 1){ // Rol coordinador de zona, solo le manda sus anfitriones
            $users = User::where('parent_id',auth()->user()->id)->pluck('name','id');

        }else{
            $users = User::where('id_rol','!=',1)->pluck('name','id');
        }
       
        // Variable para el lava charts para mostrar el usuario
        $user = User::where('id',$id)->pluck('name');
        
       // Validar preguntas respondidas con las que faltan por responder
        $totalPreguntasPorChecklist = Pregunta::where('id_checklist',$check)->get();
        $totalPreguntasPorChecklistRespondidas = Respuesta::where('id_checklist',$check)
        ->where('id_usuario',$id)->where('fecha',$request->input('fecha_desde'))->get();
        
        
        
        $respuestaNo = Respuesta::where('respuesta',0)->where('id_usuario',$id)
        ->where('id_checklist',$check)
        ->whereRaw('fecha >="'.$request->input('fecha_desde').'" and fecha <="'.$request->input('fecha_hasta').'"')->get();
       
        $respuestaSi = Respuesta::where('respuesta',1)->where('id_usuario',$id)->where('id_checklist',$check)
        ->whereRaw('fecha >="'.$request->input('fecha_desde').'" and fecha <="'.$request->input('fecha_hasta').'"')->get();
       
        $lava = new Lavacharts; //Se instancia la clase para los informes
      
        //Valida la cantidad de preguntas respondidas con si y con no
        $respuestas = $lava->DataTable();
        $respuestas->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Respondidas si', count($respuestaSi) ])
            ->addRow(['Respondidas no',count($respuestaNo) ]);
            
    
        $totalP= count($totalPreguntasPorChecklist);
        //dd($totalP);
        $respondidas=count($totalPreguntasPorChecklistRespondidas);
        //dd($respondidas);
        $faltaResponder= $totalP-$respondidas;
        //dd($faltaResponder);
        
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
            'title' => 'Tienda: '.$usuario
        ]);    
        $lava->DonutChart('consulta2', $preguntasYrespuestas, [
            'title' => 'Checklist: '.$msgCheck
        ]);
    
        return view('reportes.reporteTiendas', compact('lava','users','checklist'));
        
    }
}
