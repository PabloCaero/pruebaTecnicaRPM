<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
  

    public function login(Request $request){
        
        $credentials = [
        "email" => $request->email,
        "password" => $request->password,
        //"active" => true;
        ];

        $remember = ($request->hast('remember') ? true : false);   

        if(Auth::attemp($credentials, $remember)){
            $request->session()->regenerate();  
            
            return redirect()->intended(route('login'));
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