<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frecuencia extends Model
{
    protected $table = 'frecuencias';
    
    protected $fillable = [
       'Nombre', 
       'Descripcion',
        'Fecha_inicial',
        'Fecha_final'
    ];

}
