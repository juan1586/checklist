<div class="form-group">
    {!! Form::label('Nombre','Frecuencia Pregunta') !!}
    {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Descripcion','Descripción') !!}
  {!! Form::textarea('Descripcion', null, ['class' => 'form-control','rows' =>'2']) !!}
</div>
<div>
  {!! Form::label('Fecha_inicial','Desde') !!}
  {{ Form::date('Fecha_inicial', null,['class' => 'form-control']) }}
</div>
<div>
  {!! Form::label('Fecha_final','Hasta') !!}
  {{ Form::date('Fecha_final', null,['class' => 'form-control']) }}
</div>


