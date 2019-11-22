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
            <a href="{{url()->previous()}}" class="btn btn-success btn-sm">Atras</a>
          </div>
        
    {!! Form::close() !!}
  </div>
  <!-- Dias especiales-->
  <div class="col-sm-3">
    <table> 
      <th></th>
      <th colspan="3"></th>
      <tbody>
        <h3>Aparicion por fecha</h3><a href="{{ route('apar',$frecuencia->id)}}" class="btn btn-info btn-sm">Crear nueva aparición</a>
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
  
  <!-- Dias de la semana-->
  <div class="col-sm-3">
    <table> 
      <th></th>
      <th colspan="3"></th>
      <tbody>
        <h3>Aparición por dia</h3><a href="{{ route('aparDia',$frecuencia->id)}}" class="btn btn-info btn-sm">Crear dia</a>
        @foreach($frecuencia->aparicionDias as $aparicionDia)
          <tr>
            <td> 
            @if($aparicionDia-> numero_dia == 1)
              Lunes
            @elseif($aparicionDia-> numero_dia == 2)
              Martes
            @elseif($aparicionDia-> numero_dia == 3)
              Miercoles
            @elseif($aparicionDia-> numero_dia == 4)
              Jueves
            @elseif($aparicionDia-> numero_dia == 5)
              Viernes
            @elseif($aparicionDia-> numero_dia == 6)
              Sabado          
            @endif
            </td>
            <td> 
              {!! Form::open(['route' => ['aparicionDia.destroy',$aparicionDia->id],
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

