<?php

namespace App\Services;
use App\Respuesta;
use App\Pregunta;
use DB;
class ValidateDay
{
    //Retorna falso si el dia que entra por parametro es festivo
    // Valida los dias festivos
    public function isHoliday($day){
        $holidays = array(       
            '2019-01-01',  //  Año Nuevo (irrenunciable)
            '2019-01-07',  //  Día de los reyes magos
            '2019-04-18',  //  Semana Santa
            '2019-03-25',  //  Día de San José
            '2019-04-19',  //  Semana Santa
            '2019-05-01',  //  Día del trabajo
            '2019-06-03',  //  Día de la Ascensión
            '2019-06-24',  //  Corpus Christi
            '2019-07-01',  //  Sagrado Corazón; San Pedro y San Pablo
            '2019-07-20',  //  Día de la Independencia
            '2019-08-07',  //  Batalla de Boyacá
            '2019-08-19',  //  La asunción de la Virgen
            '2019-10-14',  //  Día de la Raza
           // '2019-11-04',  //  Todos los Santos
            '2019-11-11',  //  Independencia de Cartagena
            '2019-12-25',  //  Natividad del Señor 
        );
        for($i = 0; $i < count($holidays); $i++){
            if($holidays[$i] == $day){
                return false;
                break;
            }            
        }
        return true;
    }  
    
    // Retorna verdadero si el día es igual para mostrar el checklist.
    // Frecuencia Bimestral
    public function bimonthly($day){
        $holidays = array(       
            '2019-10-16',  
            '2019-10-17',
            
     );
        for($i = 0; $i < count($holidays); $i++){
            if($holidays[$i] == $day){
                return true;
                break;
            }            
        }
        return false;
    }   
   // Retorna verdadero si el día es igual.
   // Frecuencia Semestral.
    public function biannual($day){
        $date = array(       
            '2019-10-17',  
            
        );
        for($i = 0; $i < count($date); $i++){
            if($date[$i] == $day){
                return true;
                break;
            }            
        }
        return false;
    }  

    // Retorna falso si es sabado o domingo.
    public function dayNotEnabled($day){
        $days = array(       
            6,  // Sabado.
            7, // Domingo.
            
        );
        for($i = 0; $i < count($days); $i++){
            if($days[$i] == $day){
                return false;
                break;
            }            
        }
        return true;
    }

    // Valida si hay preguntas por responder.
    
    public function btnActive($id_checklist)
    {
        // $preguntas = DB::select('SELECT *FROM preguntas as t1
        // WHERE NOT EXISTS
        //     (SELECT * FROM respuestas as t2 WHERE t1.id = t2.id_pregunta and t2.fecha =(select CURDATE())  and t2.id_usuario =?)
        // AND t1.id_checklist =?', [auth()->user()->id,$id_checklist]);


       // Consulta mejorada con respecto a la anterior
        $preguntas = Pregunta::select('id','Nombre','descripcion','id_checklist')
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('respuestas')
                ->whereRaw('preguntas.id = respuestas.id_pregunta')
                ->whereRaw('respuestas.fecha=(select CURDATE())')
                ->where('id_usuario', auth()->user()->id);
        })->where('id_checklist',$id_checklist)->get();
        if(count($preguntas) > 0){
            return true;
        }
        return false;
    }      
}
