@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-sm-6">
    {!! Form::model($frecuencia,['route' => ['frecuencia.update',$frecuencia->id],
        'method' => 'PUT','files' => true]) !!}
          @include('frecuencias.partials.form')
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
        <h3>Apariciones</h3><a href="{{ route('apar', $frecuencia->id)}}" class="btn btn-info btn-sm">Crear nueva aparición</a>
        @foreach($frecuencia->apariciones as $aparicion)
          <tr>
            <td> 
            {{ $aparicion ->aparicion}}
            </td>
            <td><a href="{{ route('aparicion.edit', $aparicion->id)}}">-Editar</a></td>
            <td> 
              {!! Form::open(['route' => ['aparicion.destroy',$aparicion->id],
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

