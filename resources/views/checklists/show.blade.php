@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>¿Seguro deseas eliminar este registro?</h2></div>

                    <div class="card-body">
                       <p> Id :<strong> {{$checklist->id}}</strong></p>
                       <p> Nombre:<strong> {{$checklist->Nombre}}</strong></p>
                       <p> Nombre checklist:<strong> {{$checklist->Descripcion}}</strong></p>
                       <p> Aplica a:<strong> {{$checklist->users->name}}</strong></p> 
                       <p> frecuencia:<strong> {{$checklist->frecuencias->Nombre}}</strong></p>                     
                       <p> Aplica:<strong> {{$checklist->tipo->Nombre}}</strong></p>                     
                    </div>
                    <div>
                        {!! Form::open(['route' => ['checklist.destroy',$checklist->id],
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
