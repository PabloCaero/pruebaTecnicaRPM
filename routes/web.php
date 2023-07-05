<?php

use Illuminate\Support\Facades\Route;

/*************RUTAS DE LAS VISTAS*************/

Route::get('/', function () {
    return view('login');
});

Route::get('/actualizar', function () {
    return view('actualizar');
});

Route::get('/agregar', function () {
    return view('agregar');
});

Route::get('/auditoria', function () {
    return view('auditoria');
});

Route::get('/eliminar', function () {
    return view('eliminar');
});

Route::get('/inicio', function () {
    return view('inicio');
});

/**********************************************/

/*************RUTAS DE LOS CONTROLADORES*************/



/****************************************************/