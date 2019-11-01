@extends('layouts.admin')


@section('content')  
    @if($preguntas->total() == 0)
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="alert alert-success alert-dismissible text-center">
                <button  class="close" data-dismiss="alert" aria-label="close">&times</button>
            <strong>Ya no tienes mas tares por responder!!</strong> 
            </div>
          </div>
        </div> 
      </div>
    @endif
    @php($con = 0)
    <p>
    <a href="/mail" class="btn btn-sm btn-danger pull-right">Enviar Email</a>
    </p>
    @foreach ($preguntas as  $pregunta)  
      {!! Form::open(['route' => 'auditor.store', 'method' =>'POST','files' => true, 'class'=>'frms']) !!}     
        <div class="form-group">
        <a href="{{ route('auditor.show', $pregunta->id)}}">Ver</a>
          {!! Form::hidden('id_pregunta', $pregunta->id, ['class' => 'form-control']) !!}
          {!! Form::hidden('id_usuario', auth()->user()->id, ['class' => 'form-control']) !!}
          {!! Form::hidden('id_checklist',$pregunta->id_checklist, []) !!}
          {!! Form::file('imagen')!!}
          {!! Form::label('Nombre',$pregunta->Nombre, ['class' => '']) !!}
          <label>
          {{Form::checkbox('respuesta',1,0,['onclick'=>'marcado("'.$con.'")']) }} Si
          </label> 
          <label>
          {{Form::checkbox('respuesta',0,0,['onclick'=>'marcado("'.$con.'")']) }} No
          </label> 
          @php($con++)
        </div>
        
         {!! Form::hidden('descripcion',$pregunta->descripcion,['class'=>'descripcion']) !!}
      
      {!! Form::close() !!} 
    @endforeach 

    <script>
      function marcado(i){     
      var formulario =  document.getElementsByClassName('frms')[i];
  
      formulario.submit();     
      }       
        
    </script>
        
@endsection