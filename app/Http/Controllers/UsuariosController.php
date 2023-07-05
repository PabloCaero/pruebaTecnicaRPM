<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    
    public function index()
    {
      
        $datos =  Usuarios::orderBy('id', 'desc')->paginate(3);

        return view('inicio', compact('datos')); //ENTRE COMILLAS SIMPLES
    }

    public function create()
    {
         return view('agregar');
    }

   
    public function store(Request $request)
    {
         //Sirve para guardar datos en la BD
         $usuarios = new  Usuarios();

         //PARA TOMAR DATOS DEL FORMULARIO

         $usuarios->nombre = $request->post('nombre');
         $usuarios->apellido = $request->post('apellido');
         $usuarios->email = $request->post('email');
         $usuarios->password = $request->post('password');
         $usuarios->estado = $request->post('estado');
         $usuarios->foto = $request->post('foto');

         //METODO PARA GUARDAR
         $usuarios->save();
 
         //PARA RETORNAR
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

        //PARA TOMAR DATOS DEL FORMULARIO

        $usuarios->nombre = $request->post('nombre');
        $usuarios->apellido = $request->post('apellido');
        $usuarios->email = $request->post('email');
        $usuarios->password = $request->post('password');
        $usuarios->estado = $request->post('estado');
        $usuarios->foto = $request->post('foto');

         //METODO PARA GUARDAR
         $usuarios->save();

         //PARA RETORNAR
         return redirect()->route("usuarios.index")->with("success", "Usuario modificado con éxito!");
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
