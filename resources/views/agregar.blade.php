@extends('layout/plantilla')

@section("tituloPagina", "Agregar Nuevo Usuario")

@section('contenido')

<div class="card">
    <h5 class="card-header">Agregar Nuevo Usuario</h5>
    <div class="card-body">
     
      <p class="card-text">
            <form action="{{route('usuarios.store')}}" method= "POST">
              @csrf <!--METODO PARA SEGURIDAD-->

                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>

                <label for="">Apellido</label>
                <input type="text" name="apellido" class="form-control" required>

                <label for="">Email</label>
                <input type="email" name="email" class="form-control" required>          

                <label for="">Password</label>
                <input type="password" name="password" class="form-control" required>

                <label for="">Estado</label>
                <select name="estado" class="form-select" required>
                  <option value="activo">Activo</option>
                  <option value="inactivo">Inactivo</option>
                </select>

                <label for="">Foto</label>
                <input type="text" name="foto" class="form-control">

                <br>

                <!--PARA REGRESAR-->
                <a href="{{route("usuarios.index")}}" class="btn btn-info">                  
                  <span class="fas fa-undo-alt"> </span> Regresar 
                </a>

                <!--PARA INSERTAR DATOS-->
                <button class="btn btn-primary">
                  <span class="fas fa-user-plus"> </span> Agregar
                </button>
                  
            </form>

      </p>
    
    </div>
  </div>


@endsection