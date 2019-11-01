<div class="form-group">
    {!! Form::label('Nombre','Sub tarea') !!}
    {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('pregunta_id', $subpregunta->id, ['class' => 'form-control']) !!}
</div>


