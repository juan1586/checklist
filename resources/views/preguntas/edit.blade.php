@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-sm-6">
    {!! Form::model($pregunta,['route' => ['pregunta.update',$pregunta->id],
    'method' => 'PUT','files' => true]) !!}
      @include('preguntas.partials.form')
      <br>
      <div class="form-group">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
      </div>
    {!! Form::close() !!}
  </div>
  <div class="col-sm-6">
    <table> 
      <th></th>
      <th colspan="3"></th>
      <tbody>
      <h3>Subtarea</h3><a href="{{ route('subp', $pregunta->id)}}" class="btn btn-info btn-sm">Crear nueva sub pregunta</a>
        @foreach($pregunta->subPreguntas as $sub)
          <tr>
            <td> 
            {{ $sub ->Nombre}}
            </td>
            <td><a href="{{ route('subpregunta.edit', $sub->id)}}">-Editar</a></td>
            <td> 
              {!! Form::open(['route' => ['subpregunta.destroy',$sub->id],
                'method'=> 'DELETE']) !!}
                  <button class="btn btn-link"> Eiminar</button>
              {!! Form::close() !!}
            </td>
          <tr>
        @endforeach
      <tbody>
    </table>
  </div>
</div> 
@endsection
