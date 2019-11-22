@extends('layouts.admin')

@section('content')
    <div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
        <div class="caption">
            <h3>{{ $pregunta->Nombre}}</h3>
            <h4><strong>{{ $pregunta->Descripcion}}</strong></h4>
            
                @foreach( $pregunta->subPreguntas as $sub)
                    <p>*{{ $sub->Nombre }}</p>
                @endforeach
            
            <p><a href="{{ route('Check', $pregunta->id_checklist)}}">Ir a la lista de chequeo</a></p>
             @if(Auth::user()->id_rol != 3 ) <!-- Valida que el usuario no sea anfitrion. -->
              <p><a href="/pregunta"></i>Ir a menú principal</a></p>
            @endif
        </div>
        </div>
    </div>
    </div>
@endsection
