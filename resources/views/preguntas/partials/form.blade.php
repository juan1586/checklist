<div class="form-group">
    {!! Form::label('Nombre','Pregunta o Actividad') !!}
    {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('descripcion','Descripción') !!}
    {!! Form::textArea('descripcion', null, ['class' => 'form-control','rows'=>'2']) !!}
</div>
<div class="form-group">
    <label>CheckList a la que pertenece la pregunta</label>
    {!! Form::select('id_checklist', $checklists, null, ['class' => 'form-control']) !!}
</div>

