@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Usuario: {{$user->name}} </h2></div>

                    <div class="card-body">
                       <p> Id :<strong> {{$user->id}}</strong></p>
                       <p> Email:<strong> {{$user->email}}</strong></p>
                       <p> Rol : <strong>{{$user->roles->Nombre}}</strong></p>
                    </div>
                    <div>
                    <hr/>
                    <!-- Solo los coordinadores tiene tiendas a cargo -->
                    @if($user->roles->id != 3)
                        <h3>Tiendas a cargo</h3>
                        @foreach($user->services as $service)
                            *{{ $service->name }}
                        @endforeach
                    @endif
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
