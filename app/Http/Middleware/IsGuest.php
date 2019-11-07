<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;

class IsGuest
{
    protected $auth; 
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    //Me valida que el usuario no sea un invitado en este caso id 4
    public function handle($request, Closure $next)
    {
        if($this->auth->user()->id_rol === 1 || $this->auth->user()->id_rol === 2  || $this->auth->user()->id_rol === 3)
        {
            return $next($request);

        }else{
            return redirect('/home')->with('error', 'Tienes un rol de invitado');
           
        }
    }
}
