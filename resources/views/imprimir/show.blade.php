@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>¿Seguro deseas eliminar este registro?</h2></div>

                    <div class="card-body">
                       <p> Id :<strong> {{$preguntaImprimir->id}}</strong></p>
                       <p>Nombre:<strong> {{$preguntaImprimir->Nombre}}</strong></p>
                       <p> Descripción:<strong> {{$preguntaImprimir->descripcion}}</strong></p>                    
                    </div>
                    <div>
                        {!! Form::open(['route' => ['imprimir.destroy',$preguntaImprimir->id],
                        'method'=> 'DELETE']) !!}
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                        {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
