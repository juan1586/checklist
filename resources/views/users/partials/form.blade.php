<div class="form-group">
    {!! Form::label('name','Nombre del Usuario') !!}
    {!! Form::text('name', null, ['class'=> 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email','Email') !!}
    {!! Form::email('email', null, ['class'=> 'form-control']) !!}
</div>
<div class="form-group">
    <label>Rol</label>
    {!! Form::select('id_rol', $roles, null, ['class' => 'form-control']) !!}
</div>
@if($user->roles->id == 3)
<div class="form-group">
    <label>Pertenece a</label>
    {!! Form::select('parent_id', $users, null, ['class' => 'form-control','placeholder'=>'Coordinador al que pertenece']) !!}
</div>
@endif


