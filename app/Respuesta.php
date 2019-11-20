<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table="respuestas";

    protected $fillable =[
        'id_pregunta',
        'respuesta',
        'imagen',
        'id_usuario',
        'id_checklist',
        'tienda_id_no_fk',
        'contSub',
    ];

    protected $casts = [
        'fecha' => 'datetime:m-d-Y',
        'hora' => 'datetime:H:i:s'
    ];

    public function pregunta()
    {//Una pregunta pertenece a una respuesta
        return $this->belongsTo(Pregunta::class,'id_pregunta');
    }
    
    public function user()
    {//Una pregunta pertenece a una respuesta
        return $this->belongsTo(User::class,'id_usuario');
    }

    
}
