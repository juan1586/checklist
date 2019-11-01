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
            
            <p><a href="/auditor/">Ir a checklist</a></p>
        </div>
        </div>
    </div>
    </div>
@endsection
