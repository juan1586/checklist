<?php

namespace App\Http\Controllers;
use Khill\Lavacharts\Lavacharts;
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

    public function reporteTiendas(Request $request)
    { 
        $users = User::where('id_rol','!=',1)->pluck('name','id');
        $id = $request->input('tienda_id');
        $user = User::where('id',$id)->pluck('name');
        
        $respuestaNo = Respuesta::where('respuesta',0)->where('id_usuario',$id)
        ->whereRaw('fecha >="'.$request->input('fecha_desde').'" and fecha <="'.$request->input('fecha_hasta').'"')->get();
        $respuestaSi = Respuesta::where('respuesta',1)->where('id_usuario',$id)
        ->whereRaw('fecha >="'.$request->input('fecha_desde').'" and fecha <="'.$request->input('fecha_hasta').'"')->get();
        $rNo = count($respuestaNo);
        $rSi = count($respuestaSi);
        
        $lava = new Lavacharts;
        
        $reasons = $lava->DataTable();
        $reasons->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Respondidas',$rSi ])
            ->addRow(['No Respondidas',$rNo ]);
            
        $usuario = "Sin resultados";// Guarda este string si no hay tienda por request
        if(count($user) > 0){
            $usuario = $user[0];// Si hay tienda en la consulta le da valor y la manda a la vista reportes
        }
        $donutchart = $lava->DonutChart('IMDB', $reasons, [
            'title' => 'Tienda '.$usuario
        ]);    
    
        return view('reportes.reporteTiendas', compact('lava','lava2','users'));
        
    }
}
