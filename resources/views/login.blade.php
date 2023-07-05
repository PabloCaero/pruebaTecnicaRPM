@extends('layout/plantilla')

@section('tituloPagina', 'Login')

@section('contenido')


    <div class="card">
        <h5 class="card-header">LOGIN</h5>
        <div class="card-body">

            <form method="POST" action="{{ route('inicia-sesion') }}">
                @csrf
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember">
                    <label class="form-check-label" for="rememberCheck">Mantener sesión iniciada</label>
                </div>

                <div>
                    <p>Registrarse <a href="{{ route('registro') }}"</p>
                </div>

                <button type="submit" class="btn btn-primary">Acceder</button>



            </form>





            </p>

        </div>
    </div>




@endsection
