
@extends('layouts.admin')

@section('content')
  {!! Form::open(['route' => 'aparicionDia.store', 'method' =>'POST','files' => true]) !!}
    <div class="form-group">
      {!! Form::label('numero_dia','Día') !!}
      {!! Form::select('numero_dia',[
                              '1' =>'Lunes',
                              '2'=>'Martes',
                              '3'=>'Miercoles',
                              '4'=>'Jueves',
                              '5'=>'Viernes',
                              '6'=>'Sabado',
                              ],
                              null, ['class'=>'form-control','placeholder'=>'Seleccione Día']) !!}
      {!! Form::hidden('frecuencia_id', $frecuencia->id, ['class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
      <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
    </div>
    
  {!! Form::close() !!}
        
        
 @endsection