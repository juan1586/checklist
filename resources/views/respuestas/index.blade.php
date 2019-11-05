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
<table class="table-striped table-bordered table-condensed table-hover col-sm-12">
<tr>
  <th>
    Tarea
  </th>
  <th>
    Completada
  </th>
  <th>
    Mas informacion
  </th>
</tr>

@php($con = 0)
@foreach ($preguntas as $pregunta)
{!! Form::open(['route' => 'store', 'method' =>'POST','files' => true, 'class'=>'frms']) !!}
<div class="form-group">
  {!! Form::hidden('id_pregunta', $pregunta->id, ['class' => 'form-control']) !!}
  {!! Form::hidden('id_usuario', auth()->user()->id, ['class' => 'form-control']) !!}
  {!! Form::hidden('id_checklist',$pregunta->id_checklist, []) !!}
</div>
<div class="form-group">
  <div class="form-check form-check-inline">
  <tr>
    <td>
    {!! Form::label('Nombre',$pregunta->Nombre, ['class' => 'form-check-label','for'=>'check'.$con]) !!}
   
   
    </td>
    <td>
    {{Form::checkbox('respuesta',null,null,['onclick'=>'marcado("'.$con.'")','class' => 'form-check-input', 'id' => 'Nombre']) }}

    </td>
    <td>
    <a href="{{ route('show', $pregunta->id)}}">Ver informacion adicional sobre esta tarea</a>
    </td>
    </tr>
    @php($con++)
  </div>
</div>

@foreach( $pregunta->subPreguntas as $sub)
<tr>
  <td>
  <label for=""> Subtarea: {{ $sub->Nombre }}</label>
  </td>
  <td>
  {{Form::checkbox('subRespuesta[]',1,0,[]) }} 
  </td>
  </tr>
@endforeach


{!! Form::hidden('descripcion',$pregunta->descripcion,['class'=>'descripcion']) !!}

{!! Form::close() !!}
@endforeach
</table>
<script>
  function marcado(i) {
    var formulario = document.getElementsByClassName('frms')[i];
    formulario.submit();
  }
</script>

@endsection