
@extends('layouts.admin')

@section('content')
  {!! Form::open(['route' => 'subpregunta.store', 'method' =>'POST','files' => true]) !!}
    <div class="form-group">
      {!! Form::label('Nombre','Sub tarea') !!}
      {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
      {!! Form::hidden('pregunta_id', $subpregunta->id, ['class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    
  {!! Form::close() !!}
        
        
 @endsection