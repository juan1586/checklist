@extends('layouts.admin')
@section('content')
<h2>CheckList</h2>          
<button id="permission-btn" onclick="main()">Activar Notificaciones</button>
@if($checkPendientes > 0)
    <div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
        <div class="alert alert-success alert-dismissible text-center">
            <button  class="close" data-dismiss="alert" aria-label="close">&times</button>
        <strong>Tienes {{ $checkPendientes }} checklist por responder</strong> 
        </div>
        </div>
    </div>
    </div>
@endif
<p>CheckList para el usuario: <strong>{{ Auth::user()->name }}</strong></p>

@if(!$arrayChecklists)
    <h3>¡No hay checkList pendientes!</h3>
@else
    @foreach($arrayChecklists as $checklist)
        <a href="{{ route('Check', $checklist->id)}}" class="btn btn-sm btn-success">{{ $checklist->Nombre }}</a>
    @endforeach
@endif

@if($checkPendientes > 0)
<script src="{{asset('js/app.js') }}"></script>
<script>


    //Push.Permission.has();
    //Push.create('Tienes algunos checklist por responder!! ');
</script> 
@endif
@endsection