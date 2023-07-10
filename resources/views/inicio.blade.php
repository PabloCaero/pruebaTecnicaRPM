@extends('layout/plantilla')

<!-- Para extender a la plantilla -->

@section('tituloPagina', 'Usuarios')

@section('contenido')


    <!-- TRAIDO DESDE BOOTSTRAP -->



    <div class="card">
        <h5 class="card-header d-flex justify-content-center" style=" color: #fff; background-color: #212529;">Usuarios</h5>
        <div class="card-body">


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

            <!-- PARA BUSCAR -->
            <form action="{{ route('usuarios.buscar') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Sugerencia: Buscar por Apellido, Email, Estado (Activo, Inactivo)...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
<br>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($datos as $item)
                    <div class="col">
                        <div class="card h-100">
                            @if ($item->foto)
                                <img src="{{ asset($item->foto) }}" alt="Foto" class="card-img-top"
                                    style="width: 100%;
                                height: 400px;
                                object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-center">
                                    {{ $item->apellido . ', ' . $item->nombre }}</h5>
                                <p class="card-text">
                                    <strong>ID de Usuario: </strong>{{ '#' . $item->id }} <br>
                                    <strong>Correo Electrónico: </strong>{{ $item->email }}<br>
                                <p class="d-flex justify-content-center">
                                    <span class="estado-{{ strtolower($item->estado) }} ">
                                        <strong>{{ $item->estado }}</strong>
                                    </span>
                                </p>
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <form action="{{ route('usuarios.edit', $item->id) }}" method="GET">
                                    <!--ENVIA EL ID-->
                                    <button class="btn btn-primary">
                                        <span class="fas fa-user-edit"></span> Modificar
                                    </button>
                                </form>
                                <form action="{{ route('usuarios.show', $item->id) }}" method="GET">
                                    <button class="btn btn-danger mx-1">
                                        <span class="fas fa-user-times"></span> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>







            <hr>

            <!--PAGINACIÓN-->
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">

                    {{ $datos->links() }}

                </div>
            </div>
        </div>
    </div>



<br>
@endsection
