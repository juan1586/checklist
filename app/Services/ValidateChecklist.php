<?php
namespace App\Services;
use App\Checklist;
use App\Services\ValidateDay;
use Carbon\Carbon;
class ValidateChecklist{
    public function cantidadChecklist()
    {
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
               
                if($day->appear($fechaActual,$checklists[$i]->frecuencias->id) && $day->isHoliday($fechaActual)
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
