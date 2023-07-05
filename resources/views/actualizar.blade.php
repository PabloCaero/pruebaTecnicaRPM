@extends('layout/plantilla')

@section("tituloPagina", "Actualizar Usuario")

@section('contenido')

<div class="card">
    <h5 class="card-header">Actualizar Usuario</h5>
    <div class="card-body">

      <!--RECIBO A LA PERSONA TRAIDA DESDE EL CONTROLADOR-->
      @php
        //print_r($personas); //ESTE ES NUESTRO OBJETO
      @endphp
     
      <p class="card-text">
            <form action="{{route('usuarios.update', $usuarios->id)}}" method= "POST">
              @csrf
              @method("PUT") <!--PARA ACTUALIZAR-->

              <label for="">Nombre</label>
              <input type="text" name="nombre" class="form-control" required value="{{$usuarios->nombre}}">

              <label for="">Apellido</label>
              <input type="text" name="apellido" class="form-control" required value="{{$usuarios->apellido}}">

              <label for="">Email</label>
              <input type="email" name="email" class="form-control" required value="{{$usuarios->email}}">          

              <label for="">Password</label>
              <input type="password" name="password" class="form-control" required value="{{$usuarios->password}}">

              <label for="">Estado (Actual: {{$usuarios->estado}}) </label>
              <select name="estado" class="form-select" required ">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
              </select>

              <label for="">Foto</label>
              <input type="text" name="foto" class="form-control" value="{{$usuarios->foto}}">

                <br>

                <!--PARA REGRESAR-->
                <a href="{{route("usuarios.index")}}" class="btn btn-info">
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