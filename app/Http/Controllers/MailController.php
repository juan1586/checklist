<?php

namespace App\Http\Controllers;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Services\ValidateDay;
use App\Http\Requests\StoreMailRequest;
use Exception;
use Carbon\Carbon;
use App\Respuesta;
use App\User;
use App\Pregunta;
use DB;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('zoneC');
        $this->middleware('auth');
    }

    public function create()
    {
        return View('correos.create');
    }
    // Enviar correos esta pendiente
    public function send(StoreMailRequest $request)
    {
        try{
            $data = [
                'correo' =>$request->input('correo'),
                'name'   =>$request->input('name'), // Este es el nombre de la tienda auditada
                'mensaje'=>$request->input('mensaje'),
                'usuario'=>auth()->user()->name,
            ];

            $respuestasNO = Pregunta::select('id','Nombre') // Esta consulta trae las respuestas negativas
            ->whereExists(function($query)
            {
                $query->select(DB::raw(1))
                    ->from('respuestas')
                    ->whereRaw('preguntas.id = respuestas.id_pregunta')
                    ->whereRaw('respuestas.fecha=(select CURDATE())')
                    ->where('respuesta',0)
                    ->where('id_usuario', auth()->user()->id);
            })->where('id_checklist',1)->get(); // Este check #1 es solo el de auditor.

        
            $email= $request->input('correo');
            Mail::to($email)->send(new SendEmail($data, $respuestasNO));
            
            return redirect('/indexHome')->with('info', 'Correo enviado');


        }catch(Exception $e){
            $msg = $e->getMessage();
            return back()->with('error', 'Error '.$msg);
        }
        
    }
}
