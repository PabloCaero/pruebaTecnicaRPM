<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\User;
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

    //PARA AGREGAR A LA TABLA USUARIOS
    $verificacion = Usuarios::where('email', $email)->first();

    if ($verificacion !== null) {
        return redirect()->route("usuarios.index")->with("success", "No se pudo agregar. El correo electrónico ya está registrado");
    }

    $usuarios = new Usuarios();
    $usuarios->nombre = $request->post('nombre');
    $usuarios->apellido = $request->post('apellido');
    $usuarios->email = $email;
    $usuarios->password = bcrypt($request->post('password')); //LO GUARDA EN FORMA CIFRADA
    $usuarios->estado = $request->post('estado');
    $usuarios->foto = $request->post('foto');

    
    $usuarios->save();
    
    //PARA AGREGAR A LA TABLA USERS
    $user = new User();
    $user->name = $request->input('nombre');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));

    $user->save();

    //AMBAS TABLAS TIENEN UNA RELACIÓN 1 A 1

    

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
        $usuarios->password = bcrypt($request->post('password'));
        $usuarios->estado = $request->post('estado');
        $usuarios->foto = $request->post('foto');    
        
        //PARA MODIFICAR A LA TABLA USERS
       $user = new User();
       $user = User::find($id);
       $user->name = $request->post('nombre');
       $user->email = $request->post('email');
       $user->password = bcrypt($request->post('password'));

       

       //AMBAS TABLAS TIENEN UNA RELACIÓN 1 A 1

         //METODO PARA GUARDAR
         if ($verificacion == $verificacionUsuario) {
            $usuarios->update();
            $user->update();
            return redirect()->route("usuarios.index")->with("success", "Usuario modificado con éxito, no se modificó el email.");
        }

         if ($verificacion !== null) {
            //PARA RETORNAR
         return redirect()->route("usuarios.index")->with("success", "No se pudo modificar, el mail ". $email . " esta ligado a otro usuario");
         }    

         $usuarios->update();
         $user->update();
         return redirect()->route("usuarios.index")->with("success", "Usuario modificado con éxito.");

         
    }

    
    public function destroy(Request $request, $id)
    {
        $usuarios = Usuarios::find($id);
        $user = User::find($id);

        //METODO PARA ELIMINAR
        $usuarios->delete();
        $user->delete();

        //PARA RETORNAR
        return redirect()->route("usuarios.index")->with("success", "Eliminado con éxito!");   
    }
}
