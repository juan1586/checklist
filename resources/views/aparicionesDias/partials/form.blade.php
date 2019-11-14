<div class="form-group">
    {!! Form::label('numero_dia','Dia') !!}
    {!! Form::select('numero_dia',[
                              '1' =>'Lunes',
                              '2'=>'Martes',
                              '3'=>'Miercoles',
                              '4'=>'Jueves',
                              '5'=>'Viernes',
                              '6'=>'Sabado',
                              ],
                              null, ['class'=>'form-control','placeholder'=>'Seleccione Día']) !!}
    {!! Form::hidden('frecuencia_id', $frecuencia->frecuencia_id, ['class' => 'form-control']) !!}
</div>


