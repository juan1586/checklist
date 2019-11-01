<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubPregunta extends Model
{
    protected $table = "sub_preguntas";

    protected $fillable =[
        'nombre',
    ];

    
}
