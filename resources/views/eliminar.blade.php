@extends('layout.plantilla')

@section('tituloPagina', 'Eliminar Usuario')

@section('contenido')


<p>
    <a href="{{ route('usuarios.index') }}" class="btn btn-dark">
        <span class="fas fa-undo-alt"></span> Regresar
    </a>
</p>
    <div class="card">
        <h5  class="card-header d-flex justify-content-center" style=" color: #fff; background-color: #212529;">Eliminar Usuario</h5>
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

                <table class="table table-sm">
                    <thead class="table-dark ">
                     
                            <th style="text-align: center">Nombre</th>
                            <th style="text-align: center">Apellido</th>
                            <th style="text-align: center">Email</th>                
                            <th style="text-align: center">Estado</th>
                            <th style="text-align: center">Foto</th>
                       
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center">{{ $usuarios->nombre }}</td>
                            <td style="text-align: center">{{ $usuarios->apellido }}</td>
                            <td style="text-align: center">{{ $usuarios->email }}</td>
                            <td style="text-align: center">{{ $usuarios->estado }}</td>
                            <td style="text-align: center"><img src="{{ asset($usuarios->foto) }}" alt="Foto" class="rounded-circle" style="width: 100px; height: 100px;" ></td>
                        </tr>
                    </tbody>
                </table>

                <hr>
            </p>

            <form action="{{ route('usuarios.destroy', $usuarios->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-danger">
                    <span class="fas fa-user-times"></span>
                    Eliminar
                </button>
                </div>
            </form>
        </div>
    </div>
<br>
<br>
<br>
@endsection