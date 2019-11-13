<div class="form-group">
    {!! Form::label('numero_dia','Dia') !!}
    {!! Form::select('numero_dia',['1' => 'Albania',
                              '2'=>'Kosovo',
                              '3'=>'Germany',
                              '4'=>'France'],
                              null, ['class'=>'form-control','placeholder'=>'Seleccione Día']) !!}
    {!! Form::hidden('frecuencia_id', $frecuencia->frecuencia_id, ['class' => 'form-control']) !!}
</div>


