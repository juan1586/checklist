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
    // Una frecuencia tiene muchas apariciones
    public function apariciones()
    {
        return $this->hasMany(Aparicion::class);
    }

}
