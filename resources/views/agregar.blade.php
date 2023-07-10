@extends('layout/plantilla')

@section("tituloPagina", "Agregar Nuevo Usuario")

@section('contenido')

<p>
    <a href="{{ route('usuarios.index') }}" class="btn btn-dark">
        <span class="fas fa-undo-alt"></span> Regresar
    </a>
</p>
<div class="card">
    <h5 class="card-header d-flex justify-content-center" style="color: #fff; background-color: #212529;">Agregar
        Nuevo Usuario</h5>
    <div class="card-body">

        <p class="card-text">
            <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <!--METODO PARA SEGURIDAD-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <br>
                <!--PARA INSERTAR DATOS-->
                <div class="text-center">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary">
                            <span class="fas fa-user-plus"></span> Agregar
                        </button>
                    </div>
                </div>
            </form>
        </p>

    </div>
</div>
<br>
@endsection