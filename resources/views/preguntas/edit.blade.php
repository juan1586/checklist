@extends('layouts.admin')

@section('content')
 {!! Form::model($pregunta,['route' => ['pregunta.update',$pregunta->id],
  'method' => 'PUT','files' => true]) !!}
    @include('preguntas.partials.form')
    <br>
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
  {!! Form::close() !!}

  <table> 
    <th></th>
    <th colspan="3"></th>
    <tbody>
      <strong>Subtarea</strong>-<a href="{{ route('subp', $pregunta->id)}}">crear</a>
      @foreach($pregunta->subPreguntas as $sub)
        <tr>
          <td> 
          {{ $sub ->Nombre}}
          </td>
          <td><a href="{{ route('subpregunta.edit', $sub->id)}}"> - editar</a></td>
          <td> 
            {!! Form::open(['route' => ['subpregunta.destroy',$sub->id],
              'method'=> 'DELETE']) !!}
                <button class="btn btn-link">-eiminar</button>
            {!! Form::close() !!}
          </td>
        <tr>
      @endforeach
    <tbody>
  </table>
@endsection
