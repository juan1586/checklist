@extends('layouts.admin')

@section('content')
 {!! Form::model($frecuencia,['route' => ['aparicionDia.update',$frecuencia->id],
  'method' => 'PUT','files' => true]) !!}
    @include('aparicionesDias.partials.form') 
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
   
 {!! Form::close() !!}
    
@endsection

