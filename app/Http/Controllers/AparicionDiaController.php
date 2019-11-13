<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreAparicionDiaRequest;
use App\Http\Requests\UpdateAparicionDiaRequest;
use App\AparicionDia;
use App\Frecuencia;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AparicionDiaController extends Controller
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
        return View('aparicionesDias.create', compact('frecuencia'));
    }

    public function store(StoreAparicionDiaRequest $request)
    {
        try{
            DB::BeginTransaction();
            $aparicionDia = new AparicionDia();
            $aparicionDia->numero_dia = $request->input('numero_dia');
            $aparicionDia->frecuencia_id = $request->input('frecuencia_id');
            if($aparicionDia->save()){
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
        $frecuencia = AparicionDia::find($id);
        return View('aparicionesDias.edit', compact('frecuencia'));
    }
    public function update(UpdateAparicionDiaRequest $request, $id)
    {
        try{
            DB::BeginTransaction();
            $aparicionDia = AparicionDia::find($id);
            $aparicionDia->numero_dia = $request->input('numero_dia');          
            $aparicionDia->frecuencia_id = $request->input('frecuencia_id');
            if($aparicionDia->save())
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
        AparicionDia::find($id)->delete();
        return back()->with('info','Eliminado con exito'); 
    }
}
