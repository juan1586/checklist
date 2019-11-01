<?php

namespace App\Services;
use App\Respuesta;
use App\Preguntas;
use DB;
class ValidateDay
{
    public function isHoliday($day){//Retorna falso si el dia que entra por parametro es festivo
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
            '2019-11-04',  //  Todos los Santos
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
    

    public function bimonthly($day){// Retorna verdadero si el día es igual
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
    
    public function biannual($day){// Retorna verdadero si el día es igual
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
    public function dayNotEnabled($day){// Retorna falso si es sabado o domingo
        $days = array(       
            6,  
            7,
            
        );
        for($i = 0; $i < count($days); $i++){
            if($days[$i] == $day){
                return false;
                break;
            }            
        }
        return true;
    }
    public function btnActive($id_checklist)
    {
        $preguntas = DB::select('SELECT *FROM preguntas as t1
        WHERE NOT EXISTS
            (SELECT * FROM respuestas as t2 WHERE t1.id = t2.id_pregunta and t2.fecha =(select CURDATE())  and t2.id_usuario =?)
        AND T1.id_checklist =?', [auth()->user()->id,$id_checklist]);

        if(count($preguntas) > 0){
            return true;
        }
        return false;
    }      
}
