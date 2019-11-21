<?php

namespace App\Services;
use App\Respuesta;
use App\Pregunta;
use App\Aparicion;
use App\Checklist;
use App\AparicionDia;
use App\User;

use DB;
class Reporte
{
   public function respuestas($request)
   {  
       // Se inicializa variable
       $check = trim($request->get('checklist_id'));
       $id = trim($request->get('tienda_id'));
       $desde = trim($request->get('fecha_desde'));
       $hasta = trim($request->get('fecha_hasta'));
       //Se inicializan las fechas por si viene vacias
       if($desde == Null){
           $desde = "2000-11-20";
       }
       if($hasta == Null){
           $hasta = "2020-11-20";
       }     
        if($check != Null){
            $reportes = Respuesta::where('id_checklist',$check)
            ->where('id_usuario',$id)
            ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
            ->paginate(10);
            
        }elseif(auth()->user()->roles->id == 2 && $id != Null){ // DO pendiente filtro para los CZ
            $reportes = Respuesta::where('id_usuario',$id)
            ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
            ->where('id_checklist','!=',1)->paginate(10);
        }elseif(auth()->user()->roles->id == 1){
            $reportes = Respuesta::where('id_checklist','!=',1)->paginate(10);
            if($check != Null || $id != Null){
                $reportes = Respuesta::where('id_checklist',$check)
                ->where('id_usuario',$id)
                ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
                ->paginate(10);
            }
        }else{
            $reportes = Respuesta::where('id_checklist',-1)->paginate(10);//Solo para inicializar reportes cumado no cumpla la condición
        }
        return $reportes;
   }
  // Esta funcion es la misma de arriba pero esta es requerida sin paginate en export de excel
   public function respuestasExport($request)
   {  
       // Se inicializa variable
       $check = trim($request->get('checklist_id'));
       $id = trim($request->get('tienda_id'));
       $desde = trim($request->get('fecha_desde'));
       $hasta = trim($request->get('fecha_hasta'));
       //Se inicializan las fechas por si viene vacias
       if($desde == Null){
           $desde = "2000-11-20";
       }
       if($hasta == Null){
           $hasta = "2020-11-20";
       }     
        if($check != Null){
            $reportes = Respuesta::where('id_checklist',$check)
            ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
            ->get();
            
        }elseif(auth()->user()->roles->id == 2 && $id != Null){ // DO pendiente filtro para los CZ
            $reportes = Respuesta::where('id_usuario',$id)
            ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
            ->where('id_checklist','!=',1)->get();
        }elseif(auth()->user()->roles->id == 1){
            $reportes = Respuesta::where('id_checklist','!=',1)->get();
            if($check != Null || $id != Null){
                $reportes = Respuesta::where('id_checklist',$check)
                ->where('id_usuario',$id)
                ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
                ->get();
            }
        }else{
            $reportes = Respuesta::where('id_checklist',-1)->paginate(10);//Solo para inicializar reportes cumado no cumpla la condición
        }
        return $reportes;
   }
   // Retorna el checklist de acuerdo al usuario
   public function checklist($request)
   {  
        // Se inicializa variable
        $check = trim($request->input('checklist_id'));
        $desde = trim($request->get('fecha_desde'));
       $hasta = trim($request->get('fecha_hasta'));
        //Se inicializan las fechas por si viene vacias
        if($desde == Null){
            $desde = "2000-11-20";
        }
        if($hasta == Null){
            $hasta = "2020-11-20";
        }
        //Solo se inicializa la variable checklist
        $checklist = Checklist::where('rol_id',-1)->pluck('Nombre','id');
        $id = $request->input('tienda_id');// Id de la tienda o usuario
        $usuarioRequest = User::find($id); // Buscamos el usuario o tienda
        if($usuarioRequest != NULL){            
            $usuarioAnfitrion=$usuarioRequest->parent; // Para saber si es un anfitrion

            // Esta parte me filtra los checklist q los CZ crearon para su anfitrion
            if($usuarioAnfitrion != Null  ){
                // Saca el id del CZ al que pertenece el anfitrion
                $usuarioAnfitrion->id;
                $checklist = Checklist::where('id_usuario', $usuarioAnfitrion->id)
                ->orWhere('id_usuario',1)->where('tipo_id',2)->orWhere('tipo_id',3)
                ->pluck('Nombre','id','Descripcion');
            // Si es rol anfitrión y no pertenece a un CZ
            }elseif($usuarioRequest->id_rol == 3 && $usuarioAnfitrion == Null){                
                $checklist = Checklist::where('rol_id',-1)->pluck('Nombre','id','Descripcion');
            }else{            
                // Si 
                $checklist = Checklist::where('rol_id',1)->where('id','!=',1)
                ->where('tipo_id',1)->orWhere('tipo_id',3)->pluck('Nombre','id');
            }
        }
        return $checklist;
   }
   

   // Funcion que me trae las respuestas de los retailers
   public function respuestasChecklistAuditorRetailer($request)
   {       
        $desde = trim($request->get('fecha_desde'));
        $hasta = trim($request->get('fecha_hasta'));
        $usuario = trim($request->input('tienda_id'));
        if($desde == Null){
            $desde = "2000-11-20";
        }
        if($hasta == Null){
            $hasta = "2020-11-20";
        }
        if($usuario != Null){
            $reportes = Respuesta::where('id_checklist',1)->where('id_usuario',$usuario)
            ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
            ->paginate(10);// Uno es el check de auditor->retailer
        }elseif(auth()->user()->roles->id == 1 && $usuario == Null){
            $reportes = Respuesta::where('id_checklist',1)->paginate(10);
        }else{
            $reportes = Respuesta::where('id_checklist',1)
            ->where('id_usuario',auth()->user()->id)->paginate(10);
        }
        return $reportes;
    }

    public function respuestasRetailerExport($request)
   {  
    $desde = trim($request->get('fecha_desde'));
    $hasta = trim($request->get('fecha_hasta'));
    $usuario = trim($request->input('tienda_id'));
    if($desde == Null){
        $desde = "2000-11-20";
    }
    if($hasta == Null){
        $hasta = "2020-11-20";
    }
    if($usuario != Null){
        $reportes = Respuesta::where('id_checklist',1)->where('id_usuario',$usuario)
        ->whereRaw('fecha >="'.$desde.'" and fecha <="'.$hasta.'"')
        ->get();// Uno es el check de auditor->retailer
    }elseif(auth()->user()->roles->id == 1 && $usuario == Null){
        $reportes = Respuesta::where('id_checklist',1)->get();
    }else{
        $reportes = Respuesta::where('id_checklist',1)
        ->where('id_usuario',auth()->user()->id)->get();
    }
    return $reportes;
   }
    
}
