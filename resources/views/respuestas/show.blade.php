@extends('layouts.admin')

@section('content')
    <div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
        <div class="caption">
            <h3>{{ $pregunta->Nombre}}</h3>
            <h4><strong>{{ $pregunta->descripcion}}</strong></h4>
            
                @foreach( $pregunta->subPreguntas as $sub)
                    <p>*{{ $sub->Nombre }}</p>
                @endforeach
            
            <p><a href="{{ route('Check', $pregunta->id_checklist)}}">Volver a la lista de chequeo</a></p>
            <p><a href="/pregunta"></i>Ir a menú principal</a></p>
        </div>
        </div>
    </div>
    </div>
@endsection
