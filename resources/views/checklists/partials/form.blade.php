<div class="form-group">
    {!! Form::label('Nombre','Nombre Checklist') !!}
    {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('Descripcion','Descripción') !!}
  {!! Form::textArea('Descripcion', null, ['class' => 'form-control','rows' =>'2']) !!}
</div>
<div class="form-group">
    <label>Frecuencia</label>
    {!! Form::select('id_frecuencia', $frecuencias, null, ['class' => 'form-control']) !!}
</div>
@if(auth()->user()->roles->id == 1 && $checklist->users == Null)
<div class="form-group">
    <label>Este checkList ya no pertenece a nigun usuario</label>
    <label>Lo puedes eliminar o reasignarlo</label>
    {!! Form::select('id_usuario', $usuariosCheck, null, ['class' => 'form-control','placeholder' => 'Selecciona']) !!}
</div>
@else
<div class="form-group">
    {!! Form::hidden('id_usuario', auth()->user()->id, ['class' => 'form-control']) !!}
</div>
@endif
<div class="form-group">
    <label>Aplica</label>
    {!! Form::select('tipo_id', $tipos, null, ['class' => 'form-control']) !!}
</div>