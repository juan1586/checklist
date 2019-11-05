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
       
        $tiendas = User::where('id','!=',1)->pluck('name','id');

        $reportes = Respuesta::where('id_usuario',$request->input('tienda'))
        ->whereRaw('fecha >="'.$request->input('fecha_desde').'" and fecha <="'.$request->input('fecha_hasta').'"')
        
        ->paginate(10);


        return View('reportes.index', compact('tiendas','reportes'));
    }
}
