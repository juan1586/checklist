<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';

    protected $fillable =[
        'Nombre',
        'descripcion',
        'imagen',
        'id_checklist',
    ];
 


    public function checklist()
    {//Una pregunta pertenece a un cheklist
        return $this->belongsTo(Checklist::class,'id_checklist');
    }
    public function subPreguntas()
    {//Una pregunta pertenece a un cheklist
        return $this->hasMany(SubPregunta::class);
    }
}
