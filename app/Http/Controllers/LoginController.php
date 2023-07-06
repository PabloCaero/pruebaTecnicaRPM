<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
   

    public function login(Request $request)
    {
       //VALIDACION DE CONTRASEÑA
       

        $credentials = [
        "email" => $request->email,
        "password" => $request->password,
        //ACA PODRÍA INDICARSE QUE ESTE ACTIVO
        ];

       $remember = ($request->has('remember') ? true : false);

       if(Auth::attempt($credentials,$remember)){
           

            $request->session()->regenerate();
            return redirect()->intended('inicio');

       }
       else{
        return redirect(route('login'));
       }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
      
    }
   
}