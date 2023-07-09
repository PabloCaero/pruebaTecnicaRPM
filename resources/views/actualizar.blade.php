@extends('layout/plantilla')

@section('tituloPagina', 'Actualizar Usuario')

@section('contenido')

    

    <div class="card">
        <h5 class="card-header">Actualizar Usuario</h5>
        <div class="card-body">



            <p class="card-text">
            <form action="{{ route('usuarios.update', $usuarios->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--PARA ACTUALIZAR-->

                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control" required value="{{ $usuarios->nombre }}">

                <label for="">Apellido</label>
                <input type="text" name="apellido" class="form-control" required value="{{ $usuarios->apellido }}">

                <label for="">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ $usuarios->email }}">

                <label for="">Password</label>
                <input type="password" placeholder="Si no desea modificar la contraseña, este campo debe permanecer vacío" name="password" value="" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif

                <label for="">Estado (Actual: {{ $usuarios->estado }}) </label>
                <select name="estado" class="form-select" required ">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                  </select>

                
                  <label for="">Foto</label>
                 @if ($usuarios->foto)
                    <div>
                        <img src="{{ asset($usuarios->foto) }}" alt="Foto actual" style="max-width: 200px;">
                    </div>
                @else
                    <p>No se ha cargado ninguna foto</p>
                    @endif
                    <br>
                    <input type="file" name="foto" class="form-control" accept="image/*"
                        value="{{ $usuarios->foto ? basename($usuarios->foto) : '' }}">

                    <br>
                    <br>

                    <!--PARA REGRESAR-->
                    <a href="{{ route('usuarios.index') }}" class="btn btn-info">
                        <span class="fas fa-undo-alt"> </span> Regresar </a>

                    <!--PARA INSERTAR DATOS-->
                    <button class="btn btn-warning">

                        <span class="fas fa-user-edit"></span> Modificar
                    </button>

            </form>

            </p>

        </div>
    </div>


@endsection
