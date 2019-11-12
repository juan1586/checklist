
@extends('layouts.admin')

@section('content')
  {!! Form::open(['route' => 'aparicion.store', 'method' =>'POST','files' => true]) !!}
    <div class="form-group">
      {!! Form::label('aparicion','Aparicion') !!}
      {!! Form::date('aparicion', null, ['class' => 'form-control']) !!}
      {!! Form::hidden('frecuencia_id', $frecuencia->id, ['class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    
  {!! Form::close() !!}
        
        
 @endsection