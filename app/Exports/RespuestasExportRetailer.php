<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RespuestasExportRetailer implements FromView, WithHeadings
{
    protected $respuestasRetailer;
    public function __construct($respuestasRetailer = null)
    {
        $this->respuestasRetailer = $respuestasRetailer;
    }

    public function headings(): array
    {
        // Esta parte no trae nd
        return [
            'Pregunta',
            'Respuesta',
            'Checklist',
            'Tienda',
            'Prueba',
            'Fecha',
        ];
    }

    public function view(): View
    {
        return view('exports.respuestasRetailer', [
            'reportes' =>  $this->respuestasRetailer
        ]);
    }
}
