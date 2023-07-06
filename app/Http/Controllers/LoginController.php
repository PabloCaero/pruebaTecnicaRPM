<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
   /* public function login(Request $request){
        
        $credentials = [
        "email" => $request->email,
        "password" => $request->password,
        //"active" => true;
        ];

        $email = $request->post('email');

        //CONSULTA PARA VALIDAR QUE NO SE REINGRESE UN MAIL EXISTENTE
        $verificacion = Usuarios::where('email', $email)->first();

        Auth::login($verificacion);

        $remember = ($request->hast('remember') ? true : false);   

        if(Auth::attemp($credentials, $remember)){
            $request->session()->regenerate();  
            
            return redirect()->intended(route('privada'));
        }
        else{
            return redirect(route('login'));
        }   
    }*/

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $verificacion = Usuarios::where('email', $credentials['email'])->first();

        Auth::login($verificacion);
        $request->session()->regenerate();

      return redirect()->intended(route('privada'));

        if ($verificacion) {
          if (Hash::check($credentials['password'], $verificacion->password)) {
              if (Auth::attempt($credentials)) {

                
              } else {
                return redirect(route('login'))->with('error', 'Credenciales inválidas');
            }
             } else {
            return redirect(route('login'))->with('error', 'Contraseña incorrecta');
              }
        } else {
        return redirect(route('login'))->with('error', 'Usuario no encontrado');
    }
}

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect(route('login'));
    }
   
}