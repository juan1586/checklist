@extends('layouts.admin')

@section('content')
    
    <h2>Reportes tiendas
    
    {!! Form::open(['route' => 'reporteTienda','method' => 'GET', 'class'=>'form-inline pull-right']) !!}
        <div class="form-group">
        {!! Form::select('tienda_id',$users, null, ['class' => 'form-control','placeholder' => 'Tienda']) !!}
        {!! Form::date('fecha_desde', null, ['class' => 'form-control', 'placeholder' => 'Desde']) !!}
        {!! Form::date('fecha_hasta',null, ['class' => 'form-control', 'placeholder' => 'Hasta']) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search "></span>
            </button>
        </div>
    {!! Form::close() !!}
    </h2>
    <div id="chart-div"></div>
      {!! $lava->render('DonutChart', 'IMDB', 'chart-div') !!}

@endsection