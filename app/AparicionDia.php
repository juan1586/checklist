<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AparicionDia extends Model
{
    protected $table ="aparicion_dias";

    protected $fillable =[
        'numero_dia',
        'frecuencia_id',
    ];
}
