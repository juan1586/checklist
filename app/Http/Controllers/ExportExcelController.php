<?php

namespace App\Http\Controllers;
use App\Exports\RespuestasExport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportExcelController extends Controller
{
    public function exportRespuestas(Request $request)
    {
        dd($request->all());
        return Excel::download(new RespuestasExport,'ejemplo.xlsx');
    }
}
