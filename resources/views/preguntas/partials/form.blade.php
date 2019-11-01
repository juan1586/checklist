<div class="form-group">
    {!! Form::label('Nombre','Nombre Pregunta') !!}
    {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('descripcion','Descripción') !!}
    {!! Form::textArea('descripcion', null, ['class' => 'form-control','rows'=>'2']) !!}
</div>
<div class="form-group">
    <label>CheckList</label>
    {!! Form::select('id_checklist', $checklists, null, ['class' => 'form-control']) !!}
</div>

