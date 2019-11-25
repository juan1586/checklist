<?php

namespace App\Exports;

use App\Respuesta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RespuestasExport implements FromView, WithHeadings
{
    protected $respuestas;
    public function __construct($respuestas = null)
    {
        $this->respuestas = $respuestas;
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
        return view('exports.respuestas', [
            'reportes' =>  $this->respuestas
        ]);
    }
}
