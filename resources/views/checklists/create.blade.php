@extends('layouts.admin')
@section('content')
  {!! Form::open(['route' => 'checklist.store', 'method' =>'POST','files' => true]) !!}
      <div class="form-group">
        {!! Form::label('Nombre','Nombre Checklist') !!}
        {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('Descripcion','Descripción') !!}
      {!! Form::textArea('Descripcion', null, ['class' => 'form-control','rows' =>'2']) !!}
    </div>
    <div class="form-group">
        <label>Frecuencia</label>
        {!! Form::select('id_frecuencia', $frecuencias, null, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::hidden('id_usuario', auth()->user()->id, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
        <label>Aplica</label>
        {!! Form::select('tipo_id', $tipos, null, ['class' => 'form-control']) !!}
    </div>
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
      <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
    </div>
    
  {!! Form::close() !!}
        
@endsection