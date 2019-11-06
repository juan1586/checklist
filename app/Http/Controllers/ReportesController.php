<?php

namespace App\Http\Controllers;
use App\Respuesta;
use App\User;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('admin');
        $this->middleware('auth');
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
}
