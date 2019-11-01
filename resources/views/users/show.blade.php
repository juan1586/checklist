@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>¿Seguro deseas eliminar este usuario?</h2></div>

                    <div class="card-body">
                       <p> Id :<strong> {{$user->id}}</strong></p>
                       <p>Nombre:<strong> {{$user->name}}</strong></p>
                       <p> Email:<strong> {{$user->email}}</strong></p>
                       <p> Rol : <strong>{{$user->roles->Nombre}}</strong></p>
                    </div>
                    <div>
                        {!! Form::open(['route' => ['user.destroy',$user->id],
                        'method'=> 'DELETE']) !!}
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                        {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
