@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>¿Seguro deseas eliminar este registro?</h2></div>

                    <div class="card-body">
                       <p> Id :<strong> {{$frecuencia->id}}</strong></p>
                       <p>Nombre:<strong> {{$frecuencia->Nombre}}</strong></p>
                       <p> Descripción:<strong> {{$frecuencia->Descripcion}}</strong></p>                    
                    </div>
                    <div>
                        {!! Form::open(['route' => ['frecuencia.destroy',$frecuencia->id],
                        'method'=> 'DELETE']) !!}
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                        <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
                        {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
