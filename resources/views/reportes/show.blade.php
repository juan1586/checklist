@extends('layouts.admin')

@section('content')
<div class="container">
    
   <h3>Pregunta: {{$reporte->pregunta->Nombre}}</h3>                  
    <h4>Tarea hecha?: {{ ($reporte->respuesta == 1)? "Si":"No" }}</h4>
    <h4>Prueba:</h4>
    @if($reporte->imagen != Null)
    <img class="card-img-top rounded-circle mx-auto d-block" style=" height:300px; width:300px; background-color: #EFEFEF; margin:20px" 
              src="/images/{{ $reporte->imagen }}" alt="">
  
    @else
    N/A
    @endif     
    <p>Fecha: {{$reporte->fecha->format('y-m-d') }}</p>
    <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
</div>
@endsection