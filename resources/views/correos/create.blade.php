@extends('layouts.admin')

@section('content')
<div class="page-header">
  <h3>Envio de Emails <small>tienda auditada</small></h3>
</div>
{!! Form::open(['route' => 'mail.create', 'method' =>'POST']) !!}
    
    <div class="form-group">
      {!! Form::label('Correo','Correo')!!}
      {!! Form::email('correo',null,['class'=>'form-control','placeholder'=>'Correo'])!!}
    </div>
    <div class="form-group">
      {!! Form::label('tienda','Tienda')!!}
      {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Tienda']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('mensaje','Mensaje')!!}
      {!! Form::textArea('mensaje',null,['class'=>'form-control','rows'=>'3','placeholder'=>'Mensaje'])!!}
    </div>
      {!! Form::submit('Enviar', ['class' => 'btn btn-danger btn-sm']) !!}
    
  {!! Form::close() !!}
@endsection