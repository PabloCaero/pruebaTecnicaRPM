<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Auditoria;
use App\Models\Usuarios;
use App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        
      

        return view('login'); //ENTRE COMILLAS SIMPLES
    }
   

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

        $user = Usuarios::find(Auth::id());
        if($user->estado == "Inactivo"){
            return redirect()->route('login')->with("success", "Usuario inactivo. Contacte a un administrador");
        }
           
             /****LOGICA PARA AUDITORIAS****/
             $auditoria = new Auditoria();
             $auditoria->fecha_hora = now();
             $auditoria->usuario_id = Auth::id();
             $auditoria->accion = "Inicio de sesión";
             $usuarioResponsable = Usuarios::find(Auth::id());
             $auditoria->nombre_usuario = $usuarioResponsable->apellido . ', ' . $usuarioResponsable->nombre;   
             $auditoria->save();

            $request->session()->regenerate();
            return redirect()->intended('inicio');

       }
       else{
        return redirect()->route('login')->with("success", "Correo y/o contraseña incorrecta/s");
       }
    }

    public function logout(Request $request){
        
          /****LOGICA PARA AUDITORIAS****/
          $auditoria = new Auditoria();
          $auditoria->fecha_hora = now();
          $auditoria->usuario_id = Auth::id();
          $auditoria->accion = "Cierre de sesión";
          $usuarioResponsable = Usuarios::find(Auth::id());
          $auditoria->nombre_usuario = $usuarioResponsable->apellido . ', ' . $usuarioResponsable->nombre;   
          $auditoria->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
      
    }
   
}