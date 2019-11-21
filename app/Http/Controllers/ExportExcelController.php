<?php

namespace App\Http\Controllers;
use App\Exports\RespuestasExport;
use App\Exports\RespuestasExportRetailer;
use App\Services\Reporte;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportExcelController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('zoneC');
        $this->middleware('auth');
    }
    public function exportRespuestas(Request $request)
    {
        //Clase que hace la validación de reportes es propia
        $reportesTiendas = new Reporte();
          //Filtrado de reportes
        // Esta función hace toda la validación de respuestas
        // sin paginate es por que excel no recibe paginate como consulta
        $respuestas = $reportesTiendas->respuestasExport($request);
        return Excel::download(new RespuestasExport($respuestas), 'respuestasTiendas.xlsx');
    }

    public function exportRespuestasRetailers(Request $request)
    {
         //Clase que hace la validación de reportes es propia
         $reportesTiendas = new Reporte();
         //Filtrado de reportes
       // Esta función hace toda la validación de respuestas
       // sin paginate es por que excel no recibe paginate como consulta
       $respuestasRetailer = $reportesTiendas->respuestasRetailerExport($request);
       return Excel::download(new RespuestasExportRetailer($respuestasRetailer), 'respuestasRetailers.xlsx');
    }
}
