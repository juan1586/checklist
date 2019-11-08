<?php

namespace App\Http\Controllers;
use App\User;
use App\Rol;
use Exception;
use Carbon\Carbon;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function index()
    {
       /* $date = Carbon::now();//Fecha con carbon
        dd($date->format('l jS \\ - F Y h:i:s A'));*/
        $users= User::paginate(5);
        return view('users.index',compact('users'));
    }

    public function show(User $user)
    {
        return View('users.show', compact('user'));
    }

    public function edit(User $user){
        $roles = Rol::pluck('Nombre','Id');
        return View('users.edit', compact('user','roles'));
    }
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return redirect()->route('user.index')
            ->with('info','Eliminado con exito');
        }catch(Exception $e){
            $msg = $e->getMessage();
            return back()->with('error', 'Error al eliminar '.$msg);
        }        
    }

    public function update(Request $request, User $user)
    {
       try{
            $user->update($request->all());
            return redirect()->route('user.edit',$user->id)
                ->with('info','Actualizado con exito');
       }catch(Exception $e){
            $msg = $e->getMessage();
            return back()->with('error', 'Error al editar '.$msg);
       }
        
    }

}
 