@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>¿Seguro deseas eliminar este registro?</h2></div>

                    <div class="card-body">
                       <p> Id :<strong> {{$pregunta->id}}</strong></p>
                       <p>Nombre:<strong> {{$pregunta->Nombre}}</strong></p>
                       <p> Checklist:<strong> {{$pregunta->checklist->Nombre}}</strong></p> 
                       @if($subpreguntas->total() > 0)
                       <h4>Sub tarea</h4>  
                       @endif                          
                       
                       @foreach($subpreguntas as $subPregunta)
                            <p>*
                            {{ $subPregunta->Nombre }}
                            </p>
                         @endforeach                 
                    </div>
                    <div>
                        {!! Form::open(['route' => ['pregunta.destroy',$pregunta->id],
                        'method'=> 'DELETE']) !!}
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                        {!! Form::close() !!}
                    </div>
                   <div> <a href="/pregunta"  class="">Regresar</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection