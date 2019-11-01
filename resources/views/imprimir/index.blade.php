@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <p>
                    <a href="{{ route('pdf') }} " class="btn btn-sm btn-primary  pull-right">
                        Descargar preguntas en PDF
                    </a>
                    <a href="{{ route('pdfInfo') }} " class="btn btn-sm btn-success  pull-right">
                        Visualizar PDF
                    </a>
                </p>
                <a href="/imprimir/create" class="btn btn-info btn-sm ">Nuevo</a> 

                    <div class="card-header"><h2>Preguntas para Imprimir </h2>  
                       Total Registros: {{ $preguntasImprimir->total()}} - Pagina {{ $preguntasImprimir->currentPage()}} de {{ $preguntasImprimir->lastPage()}}

                    </div>
                   
                    <div class="card-body table-responsive ">
                        <table class="table table-striped   ">
                            <th>Id</th>
                            <th>Nombre</th>    
                            <th>Descripción</th>                                            
                            <th colspan="2">&nbsp;</th>
                            <tbody>
                                @foreach ($preguntasImprimir as $imprimir)
                                    <tr>
                                        <td>{{$imprimir->id}}</td>
                                        <td>{{$imprimir->Nombre}}</td>
                                        <td>{{$imprimir->descripcion}}</td>
                                       
                                       
                                        <td width="10px">
                                            <a href=" {{ route('imprimir.show', $imprimir->id)}}" 
                                                class="btn btn-sm  btn-danger">Eliminar
                                            </a>
                                        </td>
                                        
                                        <td width="10px">
                                            <a href=" {{ route('imprimir.edit', $imprimir->id)}}" 
                                                class="btn btn-sm  btn-success">Editar
                                            </a>
                                        </td>                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      <div class="myCenter">
                         {{ $preguntasImprimir->render() }} {{--paginacion--}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection