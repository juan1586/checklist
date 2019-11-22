@extends('layouts.admin')

@section('content')
 {!! Form::model($frecuencia,['route' => ['aparicion.update',$frecuencia->id],
  'method' => 'PUT','files' => true]) !!}
    @include('apariciones.partials.form') 
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
      <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
    </div>
   
 {!! Form::close() !!}
    
@endsection

