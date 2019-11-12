<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\updateFrecuenciaRequest;
use App\Http\Requests\storeFrecuenciaRequest;

use App\Frecuencia;
use DB;
use Exception;

class FrecuenciaController extends Controller
{

    public function __construct()
    {
        $this->middleware('zoneC');
        $this->middleware('auth');
    }

    public function index()
    {
        $frecuencias = Frecuencia::orderBy('id','desc')->paginate(10);
        return View('frecuencias.index', compact('frecuencias'));
    }

    

    public function show($id)
    {
        $frecuencia=Frecuencia::find($id);
        return View('frecuencias.show', compact('frecuencia'));
    }
    public function create()
    {
        return View('frecuencias.create');
    }
   
    public function store(storeFrecuenciaRequest $request, Frecuencia $frecuencia)
    {
        
        try{
            
            DB::BeginTransaction();
            $frecuencia = new Frecuencia();
            $frecuencia->Nombre = $request->input('Nombre');
            $frecuencia->Descripcion = $request->input('Descripcion');
            $frecuencia->Fecha_inicial = $request->input('Fecha_inicial');
            $frecuencia->Fecha_final = $request->input('Fecha_final');
            if($frecuencia->save())
            {
                DB::commit();
                return redirect()->route('frecuencia.index')->with('info','creado con exito'); 
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
        $frecuencia = Frecuencia::find($id);
        return View('frecuencias.edit', compact('frecuencia'));
    }
   

    public function update(updateFrecuenciaRequest $request,$id)
    {
        try{
            DB::BeginTransaction();
            $frecuencia = Frecuencia::find($id);
            $frecuencia->Nombre = $request->input('Nombre');
            $frecuencia->Descripcion = $request->input('Descripcion');
            $frecuencia->Fecha_inicial = $request->input('Fecha_inicial');
            $frecuencia->Fecha_final = $request->input('Fecha_final');
            // Se hace esta validacion por que la frecuencia bimestral y semestral no se deben cambiar, 
        
            if($frecuencia->save())
            {
                DB::commit();
                return redirect()->route('frecuencia.index')->with('info','Editado con exito'); 
            }
            DB::rollback();
            return back()->with('error', 'Error al editar');      

        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }

    public function destroy($id)
    {
        
        $frecuencia = Frecuencia::find($id);
        $frecuencia->delete();
        return redirect()->route('frecuencia.index')->with('info','Eliminado con exito'); 
    }  

}
