<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    
    public function index()
    {
      
        $datos =  Usuarios::orderBy('id', 'desc')->paginate(3);

        return view('inicio', compact('datos')); //ENTRE COMILLAS SIMPLES
    }

    public function auditoriasRedirect()
    {
      

        return view('auditoria'); //ENTRE COMILLAS SIMPLES
    }

    public function create()
    {
         return view('agregar');
    }

   
    public function store(Request $request)
    {
    $email = $request->post('email');

    //CONSULTA PARA VALIDAR QUE NO SE REINGRESE UN MAIL EXISTENTE
    $verificacion = Usuarios::where('email', $email)->first();

    if ($verificacion !== null) {
        return redirect()->route("usuarios.index")->with("success", "No se pudo agregar. El correo electrónico ya está registrado");
    }

    $usuarios = new Usuarios();
    $usuarios->nombre = $request->post('nombre');
    $usuarios->apellido = $request->post('apellido');
    $usuarios->email = $email;
    $usuarios->password = Hash::make($request->post('password')); //LO GUARDA EN FORMA CIFRADA
    $usuarios->estado = $request->post('estado');
    $usuarios->foto = $request->post('foto');

    //VALIDA EL USUARIO?
    Auth::login($usuarios);

    $usuarios->save();

    return redirect()->route("usuarios.index")->with("success", "Agregado con éxito!");
    }

   
    public function show($id)
    {
        $usuarios = Usuarios::find($id); //BUSCA POR ID

        return view("eliminar", compact('usuarios'));
    }

   
    public function edit($id)
    {
        $usuarios = Usuarios::find($id); //BUSCA POR ID

        return view("actualizar", compact('usuarios'));
    }

   
    public function update(Request $request, $id)
    {
        $usuarios = new  Usuarios();
        
        //CONSULTA PARA VALIDAR QUE NO SE REINGRESE UN MAIL EXISTENTE
        $usuarios = Usuarios::find($id);

         $email = $request->post('email');
         $verificacion = Usuarios::where('email', $email)->first();
         $verificacionUsuario = Usuarios::find($id);

          //PARA TOMAR DATOS DEL FORMULARIO

        $usuarios->nombre = $request->post('nombre');
        $usuarios->apellido = $request->post('apellido');
        $usuarios->email = $request->post('email');
        $usuarios->password = $request->post('password');
        $usuarios->estado = $request->post('estado');
        $usuarios->foto = $request->post('foto');        

         //METODO PARA GUARDAR
         if ($verificacion == $verificacionUsuario) {
            $usuarios->update();
            return redirect()->route("usuarios.index")->with("success", "Usuario modificado con éxito, no se modificó el email.");
        }

         if ($verificacion !== null) {
            //PARA RETORNAR
         return redirect()->route("usuarios.index")->with("success", "No se pudo modificar, el mail ". $email . " esta ligado a otro usuario");
         }    

         $usuarios->update();
         return redirect()->route("usuarios.index")->with("success", "Usuario modificado con éxito.");

         
    }

    
    public function destroy(Request $request, $id)
    {
        $usuarios = Usuarios::find($id);

        //METODO PARA GUARDAR
        $usuarios->delete();

        //PARA RETORNAR
        return redirect()->route("usuarios.index")->with("success", "Eliminado con éxito!");   
    }
}
