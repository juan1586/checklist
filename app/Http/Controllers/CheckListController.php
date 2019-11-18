<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frecuencia;
use App\Checklist;
use App\User;
use App\Tipo;
use App\Http\Requests\storeChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use DB;
use Exception;

class CheckListController extends Controller
{
    public function __construct()
    {
        $this->middleware('zoneC');
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->roles->id != 1){
            $checklists =  Checklist::where('id_usuario',auth()->user()->id)->orderBy('id','desc')->paginate(10);
        }else{
            $checklists =  Checklist::orderBy('id','desc')->paginate(10);

        }


        return View('checklists.index', compact('checklists'));
    }

    public function create()
    {
        $usuarios = User::where('id_rol',auth()->user()->id)->pluck('name','id'); 
        if(auth()->user()->roles->id == 1){
            $tipos = Tipo::pluck('Nombre','id');
        }else{
            $tipos = Tipo::where('id',2)->pluck('Nombre','id');
        }
        
               
        $frecuencias = Frecuencia::pluck('Nombre','id');
        return View('checklists.create', compact('usuarios','frecuencias','tipos'));
    }

    public function store(storeChecklistRequest $request ,Checklist $checklist)
    {
        try{
            DB::BeginTransaction();
            $checklist = new Checklist();
            $checklist->Nombre = $request->input('Nombre');
            $checklist->Descripcion = $request->input('Descripcion');
            $checklist->id_frecuencia = $request->input('id_frecuencia');
            $checklist->id_usuario = $request->input('id_usuario');
            $checklist->tipo_id = $request->input('tipo_id');
            $checklist->rol_id = auth()->user()->roles->id;
            if($checklist->save())
            {
                DB::commit();
                return redirect()->route('checklist.index')->with('info','creado con exito'); 
            }
            DB::rollback();
            return back()->with('error', 'Error al crear');

        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }

    public function edit($id)
    {
        $frecuencias = Frecuencia::pluck('Nombre','id');
        $checklist = Checklist::find($id);
        //Esto garantiza que cuando se elimine un usuario se reasignen los checklist creados por el
        if($checklist->id_usuario != NUll){
            $usuarios = User::where('id_rol',auth()->user()->id)->pluck('name','id'); 
        }else{
            $usuariosCheck = User::where('id_rol',2)->pluck('name','id'); 
        }
        

        if(auth()->user()->roles->id == 1){
            $tipos = Tipo::pluck('Nombre','id');
        }else{
            $tipos = Tipo::where('id',2)->pluck('Nombre','id');
        }
       
        
        return View('checklists.edit', compact('checklist','usuarios','frecuencias','tipos','usuariosCheck'));
        
    }

    public function update(UpdateChecklistRequest $request, $id)
    {
        try{
            
            DB::BeginTransaction();
            $checklist = Checklist::find($id);
            $checklist->Nombre = $request->input('Nombre');
            $checklist->Descripcion = $request->input('Descripcion');
            $checklist->id_frecuencia = $request->input('id_frecuencia');
            $checklist->id_usuario = $request->input('id_usuario');
            $checklist->tipo_id = $request->input('tipo_id');
            if($checklist->save())
            {
                DB::commit();
                return redirect()->route('checklist.index')->with('info','Editado con exito'); 
            }
            DB::rollback();
            return back()->with('error', 'Error al crear');

        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }

    public function show($id)
    {
        $checklist = Checklist::find($id);
        return View('checklists.show', compact('checklist'));
    }

    public function destroy($id)
    {
        if($id != 1){// Este id es el checklist de auditor

            $checklist = Checklist::find($id)->delete();
        }
        return redirect()->route('checklist.index')->with('info','Eliminado con exito'); 
    }

}
