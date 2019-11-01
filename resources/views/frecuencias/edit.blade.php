@extends('layouts.admin')

@section('content')
 {!! Form::model($frecuencia,['route' => ['frecuencia.update',$frecuencia->id],
  'method' => 'PUT','files' => true]) !!}
    @include('frecuencias.partials.form')
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
   
 {!! Form::close() !!}
    
@endsection

