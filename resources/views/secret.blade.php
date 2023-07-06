@extends('layout/plantilla')

@section('tituloPagina', 'Privada')

@section('contenido')


    <div class="card">
        <h5 class="card-header">PRIVADA DE @auth {{Auth::user()->name}} @endauth</h5>
        <div class="card-body">

         




          

        </div>
    </div>




@endsection
