@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                <a href="/pregunta/create" class="btn btn-info btn-sm ">Crear una nueva pregunta</a> 

                    <div class="card-header"><h2>Panel de preguntas</h2>  
                       Total Registros: {{ $preguntas->total()}} - Pagina {{ $preguntas->currentPage()}} de {{ $preguntas->lastPage()}}

                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-striped   ">
                            <th>Id</th>
                            <th>Nombre</th>    
                            <th>CheckList</th>                                               
                            <th colspan="3">&nbsp;</th>
                            <tbody>
                                @foreach ($preguntas as $pregunta)
                                    <tr>
                                        <td>{{$pregunta->id}}</td>
                                        <td>{{$pregunta->Nombre}}
                                            @foreach($pregunta->subPreguntas as $sub)
                                            <p>*
                                            {{ $sub ->Nombre}}
                                            </p>
                                            @endforeach
                                        </td>
                                        <td>{{$pregunta->checklist->Nombre }}</td>
                                        <td width="10px">
                                            <a href=" {{ route('pregunta.show', $pregunta->id)}}" 
                                                class="btn btn-sm  btn-danger">Eliminar
                                            </a>
                                        </td>
                                        
                                        <td width="10px">
                                            <a href=" {{ route('pregunta.edit', $pregunta->id)}}" 
                                                class="btn btn-sm  btn-success">Editar
                                            </a>
                                        </td>
                                        <td>
                                         <a href="{{ route('show', $pregunta->id)}}" class="btn btn-sm btn-info">Ver</a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="myCenter">
                         {{ $preguntas->render() }} {{--paginacion--}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
