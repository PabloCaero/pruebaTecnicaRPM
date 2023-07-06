@extends('layout/plantilla')
<!-- Para extender a la plantilla -->

@section('tituloPagina', 'Usuarios')

@section('contenido')

    <!-- TRAIDO DESDE BOOTSTRAP -->

    <div class="card">
        <h5 class="card-header">CRUD de USUARIOS</h5>
        <div class="card-body">
            <h5 class="card-title text-center">Listado de Usuarios</h5>

            <!--PARA VALIDAR SESIÓN->

                

            <!--PARA QUE MUESTRE UN MENSAJE-->

            <div class="row">
                <div class="col-sm-12">
                    @if ($mensaje = Session::get('success'))
                        <!--SI MENSAJE ESTA DEFINIDO-->
                        <div class="alert alert-success" role="alert">
                            {{ $mensaje }}
                        </div>
                    @endif


                </div>
            </div>

            <p>
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                    <span class="fas fa-user-plus"> </span>
                    <!--ICONO-->
                    Agregar Nuevo Usuario

                </a>

                <a href="{{ route('auditoria.index') }}" class="btn btn-primary">
                    <span class="fas fa-user-plus"> </span>
                    <!--ICONO-->
                    Auditorias

                </a>

                <a href="{{ route('logout') }}" class="btn btn-danger">
                    <span class="fas fa-user-plus"> </span>
                    <!--ICONO-->
                    Salir

                </a>
            </p>


            <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th hidden>Password</td>
                        <th>Estado</td>
                        <th>Foto</td>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>

                        @foreach ($datos as $item)
                            <tr>
                                <td>{{ $item->nombre }}</td>
                                <td>{{ $item->apellido }}</td>
                                <td>{{ $item->email }}</td>
                                <td hidden>{{ $item->password }}</td>
                                <td>{{ $item->estado }}</td>
                                <td>{{ $item->foto }}</td>
                                <form action="{{ route('usuarios.edit', $item->id) }}" method="GET">
                                    <!--ENVIA EL ID-->
                                    <td><button class="btn btn-warning">
                                            <span class="fas fa-user-edit"></span> Modificar
                                        </button></td>
                                </form>
                                <form action="{{ route('usuarios.show', $item->id) }}" method="GET">
                                    <td><button class="btn btn-danger">
                                            <span class="fas fa-user-times"></span> Eliminar
                                        </button></td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>

            </div>
            </table>
            <hr>
            <!--PAGINACIÓN-->
            <div class="row">
                <div class="col-sm-12" >
                    {{ $datos->links() }}
                </div>
            </div>






            </p>

        </div>
    </div>




@endsection
