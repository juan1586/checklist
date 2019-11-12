<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aparicion extends Model
{
    protected $table ="apariciones";

    protected $fillable =[
        'aparicion',
        'frecuencia_id',
    ];
}
