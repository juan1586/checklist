<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\PreguntaImprimir;

class PdfController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    // ESta función imprime el archivo pdf.
    public function pdf()
    {
        $preguntasImprimir = PreguntaImprimir::where('user_id',auth()->user()->id)->get();
        $pdf = PDF::loadView('pdf.preguntas',compact('preguntasImprimir'));
        return $pdf->download('preguntas.pdf');
    }
    // Esta función visualiza el archivo pdf.
    public function pdfInfo()
    {
        $preguntasImprimir = PreguntaImprimir::where('user_id',auth()->user()->id)->get();
        $pdf = PDF::loadView('pdf.preguntas',compact('preguntasImprimir'));
        return $pdf->stream('preguntas.pdf'); 
    }
}
