<div class="form-group">
    {!! Form::label('aparicion','Aparicion') !!}
    {!! Form::date('aparicion', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('frecuencia_id', $frecuencia->frecuencia_id, ['class' => 'form-control']) !!}
</div>


