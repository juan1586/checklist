<?php
namespace App\Services;
use App\Checklist;
use App\Services\ValidateDay;
use Carbon\Carbon;
class ValidateChecklist{
    public function cantidadChecklist()
    {
        // Se crea este array global por si la condicion entra en rol 3 para asignarle valores segun se cumpla la condicion
        $checklists = array();
        $date = Carbon::now(); 
        $mes = $date->formatLocalized('%B');
        $weekday = $date->dayOfWeek;// Se obtiene el numero de la semana y si es domingo o sabado no lista el checklist
        $day = new ValidateDay(); // Clase para operar y saber los dias habiles y ni habiles
        if(auth()->user()->roles->id == 1){ // Si rol igual a Coordinador operaciones le lista todo
            $checklists = Checklist::all(); 
        }elseif(auth()->user()->roles->id == 2){ // Si rol igual a Coordinador zona le lista tipo coordinador zona o ambos
            $checklists = Checklist::where('tipo_id',1)->orWhere('tipo_id',3)->get(); 
        }elseif(auth()->user()->roles->id == 3 and auth()->user()->parent != Null){ // Si rol igual a anfitrion le lista tipo anfitrion y los check que crea su padre
            // Creado por el coordinador zona y aplica anfitrion 
            $parentTipoDos = Checklist::where('id_usuario',auth()->user()->parent->id)->where('tipo_id',2)->get(); 
            // Se itera el objeto y cada posicion es un array, se agrega a checklists q es el global declarado arriba
            for($i=0;$i<count($parentTipoDos);$i++){
                array_push($checklists, $parentTipoDos[$i]);
            }
            // Valida el rol anfitrion y luego valida que los checklist del administrador y lo agrega al nuevo arreglo  
                    
            // Creado por el coordinador operaciones y aplica anfitrion            
            $OperacionesTipoDos = Checklist::where('rol_id',1)->where('tipo_id',2)->get();
            for($i=0;$i<count($OperacionesTipoDos);$i++){
                array_push($checklists, $OperacionesTipoDos[$i]); 
            }
             // Creado por el coordinador operaciones y aplica anfitrion y CZ           
             $OperacionesTipoTres = Checklist::where('rol_id',1)->where('tipo_id',3)->get();
             for($i=0;$i<count($OperacionesTipoTres);$i++){
                 array_push($checklists, $OperacionesTipoTres[$i]); 
             }
            

        }else{
            $checklists = Checklist::where('id_usuario',-1)->get(); // Esto es solo si la propiedad parent no esta definida
        }
        $arrayChecklists = array();// Se agrega un array si cumple la condicion y se manda a la vista
        $fechaActual = $date->format('Y-m-d'); // Obtengo el dia actual año mes dia
        // Lista todos los cheklist y compara y si corresponde a cada 
        for($i=0;$i<count($checklists);$i++){
            
            if(($day->appear($fechaActual,$checklists[$i]->frecuencias->id) || $day->appearDay($weekday,$checklists[$i]->frecuencias->id))
                && $day->isHoliday($fechaActual)
                && $day->dayNotEnabled($weekday)&& $day->btnActive($checklists[$i]->id)){                       
                array_push($arrayChecklists, $checklists[$i]);
            
            }elseif(($checklists[$i]->frecuencias->Fecha_inicial <= $fechaActual 
                && $checklists[$i]->id != 1 // El checklist 1 es solo para auditor
                && $checklists[$i]->frecuencias->Fecha_final >= $fechaActual) 
                && $day->isHoliday($fechaActual)&& $day->dayNotEnabled($weekday) 
                && $day->btnActive($checklists[$i]->id)){

                    array_push($arrayChecklists, $checklists[$i]);
            }
        }
        return $arrayChecklists;
    }

}
