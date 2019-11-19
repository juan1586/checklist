<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','id_rol','parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){//Un user tiene un rol
        return $this->belongsTo(Rol::class,'id_rol');
    }
    // De un usuario se accede al usuario padre que lo contiene
    public function parent(){
        return $this->belongsTo(User::class);
    }
    // Los usuarios que un usuario continene, en este caso un coordinador zona tiene anfitriones
    public function anfitriones(){
        return $this->hasMany(User::class,'parent_id');
    }
}
