@extends('layouts.admin')

@section('content')
 {!! Form::model($subpregunta,['route' => ['subpregunta.update',$subpregunta->id],
  'method' => 'PUT','files' => true]) !!}
    @include('subpreguntas.partials.form')
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
      <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
    </div>
   
 {!! Form::close() !!}
    
@endsection

