@extends('layout.plantilla')

@section('tituloPagina', 'Auditoría')

@section('contenido')

<p>
    <a href="{{ route('usuarios.index') }}" class="btn btn-dark">
        <span class="fas fa-undo-alt"></span> Regresar
    </a>
</p>

    <div class="card">
        <h5  class="card-header d-flex justify-content-center" style=" color: #fff; background-color: #212529;">Auditorías</h5>
        <!-- PARA BUSCAR -->
        <div class="card-body">
            <form action="{{ route('auditoria.buscar') }}" method="GET" class="form-inline">
              <div class="input-group">
                  <input type="text" id="search" name="search" class="form-control" placeholder="Sugerencia: Buscar por Acción (Agregó, Modificó, Eliminó, Inicio, Cierre)...">
                  <div class="input-group-append">
                      <button type="submit" class="btn btn-primary">
                          <i class="fas fa-search"></i>
                      </button>
                  </div>
              </div>
          </form>

           
            <p class="card-text">

            

                <table class="table table-sm">

                    <!-- PARA EXPORTAR -->
                    <thead class="table-dark ">
                        <th style="text-align: center">Fecha y Hora</th>
                        <th style="text-align: center">ID de Usuario</th>
                        <th style="text-align: center">Responsable</th>
                        <th style="text-align: center">Acción</th>
                    </thead>
                    <tbody>
                        @if (!empty($auditorias) && $auditorias->count() > 0)
                            <!-- Mostrar resultados de búsqueda -->
                            @foreach ($auditorias as $item)
                                <tr>
                                    <td style="text-align: center">{{ $item->fecha_hora }}</td>
                                    <td style="text-align: center">{{ $item->usuario_id }}</td>
                                    <td style="text-align: center">{{ $item->nombre_usuario }}</td>
                                    <td style="text-align: center">{{ $item->accion }}</td>
                                </tr>
                            @endforeach
                        @else
                            <!-- Mostrar lista completa de auditorías -->
                            @foreach ($datos as $item)
                                <tr>
                                    <td style="text-align: center">{{ $item->fecha_hora }}</td>
                                    <td style="text-align: center">{{ $item->usuario_id }}</td>
                                    <td style="text-align: center">{{ $item->nombre_usuario }}</td>
                                    <td style="text-align: center">{{ $item->accion }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </p>

            <hr>

            <!--PAGINACIÓN-->
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    @if (!empty($auditorias) && $auditorias->count() > 0)
                        {{ $auditorias->links() }}
                    @else
                        {{ $datos->links() }}
                    @endif
                </div>
            </div>

        </div>
    </div>

    <br>
@endsection