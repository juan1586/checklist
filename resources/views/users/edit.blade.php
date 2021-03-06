@extends('layouts.admin')

@section('content')
 {!! Form::model($user,['route' => ['user.update',$user->id],
  'method' =>'PUT','files' => true]) !!}
    @include('users.partials.form')
  
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
      <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
    </div>
   
 {!! Form::close() !!}
    
@endsection