@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Usuarios</h2>  
                       Total Registros: {{ $users->total()}} - Pagina {{ $users->currentPage()}} de {{ $users->lastPage()}}

                    </div>

                    <div class="card-body table-responsive ">
                        <table class="table table-striped   ">
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th colspan="2">&nbsp;</th>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->roles->Nombre}}</td>
                                        <td width="10px">
                                            <a href=" {{ route('user.show', $user->id)}}" 
                                                class="btn btn-sm  btn-info">Ver
                                            </a>
                                        </td>
                                        <td width="10px">
                                            <a href=" {{ route('user.edit', $user->id)}}" 
                                                class="btn btn-sm  btn-success">Editar
                                            </a>
                                        </td>                                     
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      <div class="myCenter">
                        {{ $users->render() }} {{--paginacion--}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
