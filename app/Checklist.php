<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = 'checklists';
    protected $fillable = [
        'Nombre', 'Descripcion', 'id_frecuencia','id_usuario','tipo_id',
     ];
 

    public function frecuencias(){//Un checklist tine una frecuancia
        return $this->belongsTo(Frecuencia::class,'id_frecuencia');
    }

    public function users(){//Un checklist tine una frecuancia
        return $this->belongsTo(User::class,'id_usuario');
    }

    public function tipo(){//Un user tiene un rol
        return $this->belongsTo(Tipo::class);
    }
}
