@extends('layouts.admin')


@section('content')
@if($preguntas->total() == 0)
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="alert alert-success alert-dismissible text-center">
        <button class="close" data-dismiss="alert" aria-label="close">&times</button>
        <strong>!Ya no hay mas tareas por pendientes!</strong>
      </div>
    </div>
  </div>
</div>
@endif
@php($con = 0)
@foreach ($preguntas as $pregunta)
{!! Form::open(['route' => 'store', 'method' =>'POST','files' => true, 'class'=>'frms']) !!}
<a href="{{ route('show', $pregunta->id)}}">Ver informacion adicional sobre esta tarea</a>
<br>
<div class="form-group">
  {!! Form::hidden('id_pregunta', $pregunta->id, ['class' => 'form-control']) !!}
  {!! Form::hidden('id_usuario', auth()->user()->id, ['class' => 'form-control']) !!}
  {!! Form::hidden('id_checklist',$pregunta->id_checklist, []) !!}
</div>
<div class="form-group">
  <div class="form-check form-check-inline">

      {!! Form::label('Nombre',$pregunta->Nombre, ['class' => 'form-check-label','for'=>'check'.$con]) !!}
   
    {{Form::checkbox('respuesta',null,null,['onclick'=>'marcado("'.$con.'")','class' => 'form-check-input', 'id' => 'Nombre']) }}
    @php($con++)
  </div>
</div>
<br>
@foreach( $pregunta->subPreguntas as $sub)

  <label for=""> Subtarea:</label>
  {{Form::checkbox('subRespuesta[]',1,0,[]) }} {{ $sub->Nombre }}

@endforeach


{!! Form::hidden('descripcion',$pregunta->descripcion,['class'=>'descripcion']) !!}

{!! Form::close() !!}
@endforeach

<script>
  function marcado(i) {
    var formulario = document.getElementsByClassName('frms')[i];
    formulario.submit();
  }
</script>

@endsection