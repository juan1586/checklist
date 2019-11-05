@extends('layouts.admin')

@section('content')
    <h3>
        Reportes tiendas

        {!! Form::open(['route' => 'reporte','method' => 'GET', 'class'=>'form-inline pull-right']) !!}
        {!! Form::select('tienda', $tiendas, null, ['class' => 'form-control','placeholder' => 'Tienda']) !!}
        {!! Form::date('fecha_desde', null, ['class' => 'form-control', 'placeholder' => 'fecha']) !!}
        {!! Form::date('fecha_hasta', null, ['class' => 'form-control', 'placeholder' => 'fecha']) !!}
            <div class="form-group">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search "></span>
                </button>
            </div>
        {!! Form::close() !!}
    </h2>



    <div class="card-body table-responsive ">
        <table class="table table-striped   ">
            <th>Pregunta</th>
            <th>Respuesta</th>    
            <th>Fecha</th>                                               
            <tbody>
                @foreach ($reportes as $reporte)
                    <tr>
                        <td>{{$reporte->pregunta->Nombre}}</td>                  
                        <td>{{ ($reporte->respuesta == 1)? "Si":"No" }}</td>
                        <td>{{$reporte->fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="myCenter">
            {{ $reportes->render() }} {{--paginacion--}}
        </div>
    </div>
@endsection
