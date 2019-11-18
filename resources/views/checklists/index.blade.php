@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                <a href="/checklist/create" class="btn btn-info btn-sm ">Crear nuevo Checklist</a> 

                    <div class="card-header"><h2>CheckList </h2>  
                       Total Registros: {{ $checklists->total()}} - Pagina {{ $checklists->currentPage()}} de {{ $checklists->lastPage()}}

                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-striped   ">
                            <th>Id</th>
                            <th>Nombre</th>    
                            <th>Descripción</th>
                            <th>Creado por</th> 
                            <th>Frecuencia</th> 
                            <th>Aplica</th> 
                                                  
                            <th colspan="2">&nbsp;</th>
                            <tbody>
                                @foreach ($checklists as $checklist)
                                    <tr>
                                        <td>{{$checklist->id}}</td>
                                        <td>{{$checklist->Nombre}}</td>
                                        <td>{{$checklist->Descripcion}}</td>
                                        <!-- Estos if garantizan que cuando se borre una dependencia no se caiga la pagina -->
                                        @if($checklist->users != Null)
                                        <td>{{$checklist->users->name}}</td>
                                        @else
                                        <td>N/A</td>
                                        @endif

                                        @if($checklist->frecuencias != Null)
                                        <td>{{$checklist->frecuencias->Nombre}}</td>
                                        @else
                                        <td>N/A</td>
                                        @endif

                                        @if($checklist->tipo != Null)
                                        <td>{{$checklist->tipo->Nombre}}</td>
                                        @else
                                        <td>N/A</td>
                                        @endif
                                       
                                        <td width="10px">
                                            <a href=" {{ route('checklist.show', $checklist->id)}}" 
                                                class="btn btn-sm  btn-danger">Eliminar
                                            </a>
                                        </td>
                                        
                                        <td width="10px">
                                            <a href=" {{ route('checklist.edit', $checklist->id)}}" 
                                                class="btn btn-sm  btn-success">Editar
                                            </a>
                                        </td>                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="myCenter"> 
                        {{ $checklists->render() }} {{--paginacion--}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

