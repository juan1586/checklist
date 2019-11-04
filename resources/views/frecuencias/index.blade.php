@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                <a href="/frecuencia/create" class="btn btn-info btn-sm ">Nuevo</a> 

                    <div class="card-header"><h2>Frecuencias </h2>  
                       Total Registros: {{ $frecuencias->total()}} - Pagina {{ $frecuencias->currentPage()}} de {{ $frecuencias->lastPage()}}

                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-striped   ">
                            <th>Id</th>
                            <th>Nombre</th>    
                            <th>Descripción</th>
                            <th>Desde</th> 
                            <th>Hasta</th>                       
                            <th colspan="2">&nbsp;</th>
                            <tbody>
                                @foreach ($frecuencias as $frecuencia)
                                    <tr>
                                        <td>{{$frecuencia->id}}</td>
                                        <td>{{$frecuencia->Nombre}}</td>
                                        <td>{{$frecuencia->Descripcion}}</td>
                                        <td>{{$frecuencia->Fecha_inicial}}</td>
                                        <td>{{$frecuencia->Fecha_final}}</td>
                                       
                                        <td width="10px">
                                            <a href=" {{ route('frecuencia.show', $frecuencia->id)}}" 
                                                class="btn btn-sm  btn-danger">Eliminar
                                            </a>
                                        </td>
                                        
                                        <td width="10px">
                                            <a href=" {{ route('frecuencia.edit', $frecuencia->id)}}" 
                                                class="btn btn-sm  btn-success">Editar
                                            </a>
                                        </td>                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      <div class="myCenter">
                        {{ $frecuencias->render() }} {{--paginacion--}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
