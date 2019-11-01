<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAuditorRequest;
use App\Pregunta;
use App\Respuesta;
use App\User;
use Carbon\Carbon;
use DB;
use Exception;

class AuditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('zoneC');
    }
    public function index()
    {
        // Trae las preguntas cuando no esten respondidas, valida preguntas con respuestas
        $preguntas = Pregunta::select('id','Nombre','descripcion','id_checklist')
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('respuestas')
                ->whereRaw('preguntas.id = respuestas.id_pregunta')
                ->whereRaw('respuestas.fecha=(select CURDATE())')
                ->where('id_usuario', auth()->user()->id);
        })->where('id_checklist',12)->paginate(40); //-> El paginate es solo para operar en la vista con el total
        // Si hay preguntas por responder las manda a la vista.
        if(count($preguntas)>0 ){
            
            return View('auditor.index', compact('preguntas'));
        }else{
            // Si no hay mas preguntas hace un redirect hacia MailController para enviar
            // correo con las preguntas que se respondieron con no.
            return redirect('/mail')->with('info', 'No tienes mas tareas');
        }
    
    }

    public function store(StoreAuditorRequest $request)
    {
        $imagen="";
        // Si viene imagen la asigna con la ruta de la uvicación, si no queda vacia
        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            //concatena el nombre con el tiempo y asi se vuelve un registro unico.
            $imagen = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $imagen);
            
        }
        $date = Carbon::now();
        $hora = $date->format('h:i:s');
        $fecha = $date->format('Y-m-d');

        try{
            DB::BeginTransaction();
            $respuesta = new Respuesta();
            $respuesta->id_pregunta = $request->input('id_pregunta');
            $respuesta->respuesta = $request->input('respuesta');
            $respuesta->imagen=$imagen;
            $respuesta->hora = $hora ;
            $respuesta->fecha = $fecha;
            $respuesta->id_usuario = $request->input('id_usuario');
            $respuesta->id_checklist = $request->input('id_checklist');
            $respuesta->tienda_id_no_fk = $request->input('tienda_id_no_fk');

            if($respuesta->save()){
                DB::commit();
                return back();
            }
            DB::rollback();            
            return back()->with('error', 'Error al crear');
        }catch(Exception $e){
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }

    public function show($id)
    {
        $pregunta = Pregunta::find($id);
        return View('auditor.show', compact('pregunta'));
    }

}
