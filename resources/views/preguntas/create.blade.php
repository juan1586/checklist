
@extends('layouts.admin')

@section('content')
  {!! Form::open(['route' => 'pregunta.store', 'method' =>'POST','files' => true]) !!}
    @include('preguntas.partials.form')
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    
  {!! Form::close() !!}
        
        
 @endsection