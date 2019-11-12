
@extends('layouts.admin')

@section('content')
  {!! Form::open(['route' => 'aparicion.store', 'method' =>'POST','files' => true]) !!}
    @include('apariciones.partials.form')
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    
  {!! Form::close() !!}
        
        
 @endsection