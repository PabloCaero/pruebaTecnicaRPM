<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    public function register(Request $request){
        //VALIDACIÓN DE DATOS

        //CREACIÓN DE NUEVO USUARIO
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        //AUTENTICACIÓN
        Auth::login($user);

        return redirect(route('inicio'));


    }

    public function login(Request $request){
        
    }

    public function logout(Request $request){
        
    }
   
}