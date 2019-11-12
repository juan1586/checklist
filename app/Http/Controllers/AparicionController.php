<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAparicionRequest;
use App\Http\Requests\UpdateAparicionRequest;
use App\Aparicion;
use App\Frecuencia;
use DB;

class AparicionController extends Controller
{
    public function __construct()
    {
        // Aplica si es coordinador zona o admin zoneC
        $this->middleware('zoneC');
        $this->middleware('auth');
    }
    
   
    public function create($id)
    {
        $frecuencia = Frecuencia::find($id);
        return View('apariciones.create', compact('frecuencia'));
    }

    public function store(StoreAparicionRequest $request)
    {
        try{
            DB::BeginTransaction();
            $aparicion = new Aparicion();
            $aparicion->aparicion = $request->input('aparicion');
            $aparicion->frecuencia_id = $request->input('frecuencia_id');
            if($aparicion->save()){
                DB::commit();
                return redirect()->route('frecuencia.edit', $request->input('frecuencia_id') )->with('info','Creado con exito'); 
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
        $frecuencia = Aparicion::find($id);
        return View('apariciones.edit', compact('frecuencia'));
    }
    public function update(UpdateAparicionRequest $request, $id)
    {
        try{
            DB::BeginTransaction();
            $aparicion = Aparicion::find($id);
            $aparicion->aparicion = $request->input('aparicion');          
            $aparicion->frecuencia_id = $request->input('frecuencia_id');
            if($aparicion->save())
            {
                DB::commit();
                return back()->with('info', 'Editada con exito ');            }
            DB::rollback();
            return back()->with('error', 'Error al editar');

        }catch(Exception $e)
        {
            $msg = $e->getMessage();
            return back()->with('error', 'Error al editar '.$msg);
        }
    }
    public function destroy($id)
    {
        Aparicion::find($id)->delete();
        return back()->with('info','Eliminado con exito'); 
    }
}
