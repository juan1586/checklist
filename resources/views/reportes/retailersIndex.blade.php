@extends('layouts.admin')

@section('content') 
    <div>
        Reportes tiendas

        {!! Form::model(Request::all(),['route' => 'retailer','method' => 'GET', 'class'=>'form-inline pull-right','name'=>'frms']) !!}
            <div class="form-group">
            {!! Form::select('tienda_id',$users, null, ['class' => 'form-control','onchange'=>'marcado()','placeholder' => 'Tienda']) !!}
            <label>Desde</label>
            {!! Form::date('fecha_desde', null, ['class' => 'form-control', 'placeholder' => 'Desde']) !!}
            <label>Hasta</label>
            {!! Form::date('fecha_hasta',null, ['class' => 'form-control', 'placeholder' => 'Hasta']) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search "></span>
                </button>
            </div>
        {!! Form::close() !!}
    </div>
    <br>
    <br>
    <hr/>

    <div class="card-body table-responsive ">
        <table class="table table-striped   ">
            <th>Pregunta</th>
            <th>Respuesta</th>    
            <th>Prueba</th>    
            <th>Fecha</th>                                               
            <th>&nbsp;</th>                                               
            <tbody>
                @foreach ($reportes as $reporte)
                    <tr>
                        <td>{{$reporte->pregunta->Nombre}}</td>                  
                        <td>{{ ($reporte->respuesta == 1)? "Si":"No" }}</td>
                        <td>{{($reporte->imagen != Null)?"Cargada": "Sin archivos"}}</td>
                        <td>{{$reporte->fecha->format('y-m-d')}}</td>
                        <td><a href="{{ route('retailer.show',$reporte->id)}}" class="btn btn-info btn-sm">Ver</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="myCenter">
            {{ $reportes->render() }} {{--paginacion--}}
        </div>
    </div>
@endsection
