<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreImprimirRequest;
use App\Http\Requests\UpdateImprimirRequest;
use Illuminate\Http\Request;
use App\PreguntaImprimir;
use Exception ;
use DB;

class PreguntaImprimirController extends Controller
{
    public function __construct()
    {
        // Aplica si es coordinador zona o admin zoneC
        $this->middleware('auth');
    }

    public function index()
    {
        $preguntasImprimir = PreguntaImprimir::paginate(50);
        return View('imprimir.index', compact('preguntasImprimir'));

    }

    public function create()
    {
        return View('imprimir.create');
    }

    public function store(StoreImprimirRequest $request)
    {
        try{
            DB::BeginTransaction();
            $preguntaImprimir = new PreguntaImprimir();
            $preguntaImprimir->Nombre = $request->input('Nombre');
            $preguntaImprimir->descripcion = $request->input('descripcion');
            if($preguntaImprimir->save()){
                DB::commit();
                return redirect()->route('imprimir.index')->with('info','creado con exito'); 
            }
            DB::rollback();
            return back()->with('error', 'Error al crear');

        }catch(Exception $e){
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }

    public function edit($id)
    {
        $preguntaImprimir = PreguntaImprimir::find($id);
        return View('imprimir.edit', compact('preguntaImprimir'));
    }
    public function update(UpdateImprimirRequest $request, $id)
    {
        try{
            DB::BeginTransaction();
            $preguntaImprimir = PreguntaImprimir::find($id);
            $preguntaImprimir->Nombre = $request->input('Nombre');
            $preguntaImprimir->descripcion = $request->input('descripcion');
            if($preguntaImprimir->save()){
                DB::commit();
                return redirect()->route('imprimir.index')->with('info','creado con exito'); 
            }
            DB::rollback();
            return back()->with('error', 'Error al crear');

        }catch(Exception $e){
            $msg = $e->getMessage();
            return back()->with('error', 'Error al crear '.$msg);
        }
    }

    public function show($id)
    {
        $preguntaImprimir = PreguntaImprimir::find($id);
        return View('imprimir.show', compact('preguntaImprimir'));
    }
    public function destroy($id)
    {
        $preguntaImprimir = PreguntaImprimir::find($id)->delete();
        return redirect()->route('imprimir.index')->with('info','Eliminado con exito');
    }
    
}
