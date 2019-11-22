@extends('layouts.admin')

@section('content')
    <div>
        <h4>Reportes tiendas </h4>
        
        {!! Form::model(Request::all(),['route' => 'reporteTienda','method' => 'GET', 'class'=>'form-inline pull-right','name'=>'frms']) !!}
            <div class="form-group">
            {!! Form::select('tienda_id',$users, null, ['class' => 'form-control','onchange'=>'marcado()','placeholder' => 'Tienda']) !!}
            {!! Form::select('checklist_id',$checklist, null, ['class' => 'form-control','placeholder' => 'Seleccione checklist']) !!}
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
    <br>
  
    <div id="chart-div">
    </div>
    <div id="chart-div2">
    </div>
    
    
    {!! $lava->render('DonutChart', 'consulta1', 'chart-div') !!}
    {!! $lava->render('DonutChart', 'consulta2', 'chart-div2') !!}
      


    <script>
        function marcado() {

            var formulario = document.getElementsByName('frms')[0];
            formulario.submit();
        }
    </script>
@endsection