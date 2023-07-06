<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\LoginController;



/*************RUTAS PARA LOGIN**************/

Route::view('/login', "login")->name('login');
Route::view('/registro', "agregar")->name('registro'); //RECICLO AGREGAR
Route::view('/privada', "secret")->name('privada'); 


Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


/*******************************************/

//AUDITORIA
Route::get('/auditoria', [AuditoriaController::class, 'index']) -> name('auditoria.index');

//ASOCIAMOS EL CONTROL DE LA CLASE INDEX
Route::get('/inicio', [UsuariosController::class, 'index']) -> name('usuarios.index');

//RUTA DE FORMULARIO CREATE
Route::get('/create', [UsuariosController::class, 'create']) -> name('usuarios.create');

//RUTA DE INSERCIÓN EN LA BASE
Route::post('/store', [UsuariosController::class, 'store']) -> name('usuarios.store');

//RUTA DE FORMULARIO EDIT - DEBEMOS RECIBIR PARAMETROS
Route::get('/edit/{id}', [UsuariosController::class, 'edit']) -> name('usuarios.edit');

//RUTA DE FORMULARIO ELIMINAR
Route::delete('/destroy/{id}', [UsuariosController::class, 'destroy']) -> name('usuarios.destroy');

//RUTA DE MODIFICACIÓN EN LA BASE
Route::put('/update/{id}', [UsuariosController::class, 'update']) -> name('usuarios.update');

//RUTA PARA TRAER UN SOLO REGISTRO
Route::get('/show/{id}', [UsuariosController::class, 'show']) -> name('usuarios.show');

/****************************************************/