@extends('layout/plantilla')   <!-- Para extender a la plantilla -->

@section('tituloPagina', 'Auditoría')

@section('contenido')


<!-- TRAIDO DESDE BOOTSTRAP -->

<div class="card">
  <h5 class="card-header d-flex justify-content-center">Auditorías</h5>
  <div class="card-body">
    

    <!--PARA QUE MUESTRE UN MENSAJE-->

    

    <p>
      <a href="{{ route('usuarios.index') }}" class="btn btn-info">
        <span class="fas fa-undo-alt"></span> Regresar
    </a>
    </p>

  
    <p class="card-text">
        
        <table class="table table-sm">
            <thead class="table-dark ">
                <th style="text-align: center">Fecha y Hora</th>
                <th style="text-align: center">ID de Usuario</th>
                <th style="text-align: center">Responsable</th>
                <th style="text-align: center">Acción</th>
               
            </thead>
            <tbody>

            @foreach ($datos as $item)                         

                <tr>
                    <td style="text-align: center">{{$item -> fecha_hora}}</td>    
                    <td style="text-align: center">{{$item -> usuario_id}}</td> 
                    <td style="text-align: center">{{$item -> nombre_usuario}}</td> 
                    <td style="text-align: center">{{$item -> accion}}</td>    
                  
                               
                </tr>  
                
                @endforeach
           </tbody>

           </div>
        </table>
        <hr>
         <!--PAGINACIÓN-->
         <div class="row">
          <div class="col-sm-12 d-flex justify-content-center">
        
                  {{ $datos->links() }}
              
          </div>
      </div>

     




    </p>
   
  </div>
</div>

  

   
@endsection
