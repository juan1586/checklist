@extends('layouts.admin')

@section('content') 
    <a href="{{ action('ExportExcelController@exportRespuestasRetailers', [
        'tienda_id' => app('request')->input('tienda_id'),
        'fecha_desde' => app('request')->input('fecha_desde'),
        'fecha_hasta' => app('request')->input('fecha_hasta')]) }}" 
        class="btn btn-success pull-right">Exportar a Excel
    </a>
    <br>
    <div>
        <h4>Reportes tiendas retailers</h4>

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

    <div class="card-body table-responsive ">
        <table class="table table-striped   ">
        <th>Pregunta</th>
        <th>Respuesta</th>
        <th>Checklist</th>                
        <th>Tienda</th>                
        <th>Prueba</th>    
        <th>Fecha</th>                                              
            <th>&nbsp;</th>                                               
            <tbody>
            @foreach ($reportes as $reporte)
                <tr>
                    <td>{{$reporte->pregunta->Nombre}}</td>               
                    <td>{{ ($reporte->respuesta == 1)? "Si":"No" }}</td>
                    <td>{{$reporte->pregunta->checklist->Nombre}}</td>                  
                    <td>{{$reporte->user->name}}</td>                  
                    <td>{{($reporte->imagen != Null)?"Cargada": "Sin archivos"}}</td>
                    <td>{{$reporte->fecha->format('y-m-d')}}</td>
                    <td><a href="{{ route('reporte.show',$reporte->id)}}" class="btn btn-info btn-sm">Ver</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="myCenter">
            {{ $reportes->render() }} {{--paginacion--}}
        </div>
    </div>
    <script>
        function marcado() {

            var formulario = document.getElementsByName('frms')[0];
            formulario.submit();
        }
    </script>
@endsection
