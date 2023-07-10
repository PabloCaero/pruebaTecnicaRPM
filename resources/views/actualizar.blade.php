@extends('layout/plantilla')

@section('tituloPagina', 'Modificar Usuario')

@section('contenido')

<p>
    <a href="{{ route('usuarios.index') }}" class="btn btn-dark">
        <span class="fas fa-undo-alt"></span> Regresar
    </a>
</p>
<div class="card">
    <h5 class="card-header d-flex justify-content-center" style="color: #fff; background-color: #212529;">Modificar
        Usuario #{{$usuarios->id}}</h5>
    <div class="card-body">

        <p class="card-text">
            <form action="{{ route('usuarios.update', $usuarios->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--PARA ACTUALIZAR-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required
                                value="{{ $usuarios->nombre }}">
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" required
                                value="{{ $usuarios->apellido }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required
                                value="{{ $usuarios->email }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                placeholder="Si no desea modificar la contraseña, este campo debe permanecer vacío"
                                name="password" value="" id="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <p> Estado Actual:
                                <span class="estado-{{ strtolower($usuarios->estado) }} ">
                                    <strong>{{ $usuarios->estado }}</strong>
                                </span> </p>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Nuevo Estado</label>
                            <select name="estado" class="form-select" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Actual</label>
                            @if ($usuarios->foto)
                            <div>
                                <img src="{{ asset($usuarios->foto) }}" alt="Foto actual" style="max-width: 200px;">
                            </div>
                            @else
                            <p>No se ha cargado ninguna foto</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label"></label>
                            <input type="file" name="foto" class="form-control" accept="image/*"
                                value="{{ $usuarios->foto ? basename($usuarios->foto) : '' }}">
                        </div>
                    </div>
                </div>
                <br>
                <!--PARA INSERTAR DATOS-->
                <div class="text-center">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary">
                            <span class="fas fa-user-edit"></span> Modificar
                        </button>
                    </div>
                </div>
            </form>
        </p>
    </div>
</div>
<br>

@endsection