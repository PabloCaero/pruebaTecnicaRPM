@extends('layout.plantilla')

@section('tituloPagina', 'Eliminar Usuario')

@section('contenido')

    <div class="card">
        <h5 class="card-header">Eliminar Usuario</h5>
        <div class="card-body">
            <p class="card-text">
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        ¿Estás seguro de eliminar este usuario?
                    </div>
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th hidden>Password</th>
                            <th>Estado</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $usuarios->nombre }}</td>
                            <td>{{ $usuarios->apellido }}</td>
                            <td>{{ $usuarios->email }}</td>
                            <td hidden>{{ $usuarios->password }}</td>
                            <td>{{ $usuarios->estado }}</td>
                            <td><img src="{{ asset('storage/fotos/' . $usuarios->foto) }}" alt="Foto" class="rounded-circle" style="width: 50px; height: 50px;"></td>
                        </tr>
                    </tbody>
                </table>

                <hr>
            </p>

            <form action="{{ route('usuarios.destroy', $usuarios->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <!--PARA REGRESAR-->
                <a href="{{ route('usuarios.index') }}" class="btn btn-info">
                    <span class="fas fa-undo-alt"></span> Regresar
                </a>
                <button class="btn btn-danger">
                    <span class="fas fa-user-times"></span>
                    Eliminar
                </button>
            </form>
        </div>
    </div>

@endsection