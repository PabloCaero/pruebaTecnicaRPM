@extends('layout/plantilla')   <!-- Para extender a la plantilla -->

@section('tituloPagina', 'Auditoría')

@section('contenido')


<!-- TRAIDO DESDE BOOTSTRAP -->

<div class="card">
  <h5 class="card-header">Auditoría</h5>
  <div class="card-body">
    <h5 class="card-title text-center">Registro de Acciones</h5>

    <!--PARA QUE MUESTRE UN MENSAJE-->

    

    <p>
      <a href="{{ route('usuarios.index') }}" class="btn btn-info">
        <span class="fas fa-undo-alt"></span> Regresar
    </a>
    </p>

  
    <p class="card-text">
        <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <th>Fecha y Hora</th>
                <th>ID de Usuario</th>
                <th>Responsable</th>
                <th>Acción</th>
               
            </thead>
            <tbody>

            @foreach ($datos as $item)                         

                <tr>
                    <td>{{$item -> fecha_hora}}</td>    
                    <td>{{$item -> usuario_id}}</td> 
                    <td>{{$item -> nombre_usuario}}</td> 
                    <td>{{$item -> accion}}</td>    
                  
                               
                </tr>  
                
                @endforeach
           </tbody>

           </div>
        </table>
        <hr>
        <!--PAGINACIÓN-->
         <div class="row">
                <div class="col-sm-12">
                    {{ $datos->links() }}
                </div>
            </div>

     




    </p>
   
  </div>
</div>

  

   
@endsection
