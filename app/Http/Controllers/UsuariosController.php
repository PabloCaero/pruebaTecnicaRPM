<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\User;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    
        // PARA VALIDAR Y GUARDAR RUTA DE FOTO
        $ruta = '';
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nombreArchivo = $request->input('foto') . '_' . time() . '.' . $foto->getClientOriginalExtension();
            $ruta = $foto->storeAs('public/fotos', $nombreArchivo);
        }
        
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
        $usuarios->foto = $ruta ? Storage::url($ruta) : 'sinfoto.png';
    
        $usuarios->save();
    
        //PARA AGREGAR A LA TABLA USERS
        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
    
        $user->save();
    
        //AMBAS TABLAS TIENEN UNA RELACIÓN 1 A 1
    
        /****LOGICA PARA AUDITORIAS****/
        $auditoria = new Auditoria();
        $auditoria->fecha_hora = now();
        $auditoria->usuario_id = Auth::id();
        $auditoria->accion = "Agregó un usuario";
        $usuarioResponsable = Usuarios::find(Auth::id());
        $auditoria->nombre_usuario = $usuarioResponsable->apellido . ', ' . $usuarioResponsable->nombre;
        $auditoria->save();
    
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
    // PARA VALIDAR Y GUARDAR RUTA DE FOTO
    $ruta = '';
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $nombreArchivo = $request->input('foto') . '_' . time() . '.' . $foto->getClientOriginalExtension();
        $ruta = $foto->storeAs('public/fotos', $nombreArchivo);
    }

    $usuarios = Usuarios::find($id);

    if ($usuarios === null) {
        return redirect()->route("usuarios.index")->with("success", "No se encontró el usuario");
    }

    //CONSULTA PARA VALIDAR QUE NO SE REINGRESE UN MAIL EXISTENTE
    $verificacion = Usuarios::where('email', $request->post('email'))->where('id', '!=',$id)->first();

    if ($verificacion !== null) {
        return redirect()->route("usuarios.index")->with("success", "No se pudo modificar, el correo electrónico ya está registrado en otro usuario");
    }

    //PARA TOMAR DATOS DEL FORMULARIO
    $usuarios->nombre = $request->post('nombre');
    $usuarios->apellido = $request->post('apellido');
    $usuarios->email = $request->post('email');
    $passwordNuevo = $request->post('password');
   if (Hash::check($passwordNuevo, $usuarios->password)) {
       //LA CONTRASEÑA NO SE MODIFICA
   } else {
       $usuarios->password = Hash::make($passwordNuevo);
   }
    $usuarios->estado = $request->post('estado');
   
    $usuarios->foto = $ruta ? Storage::url($ruta) : $usuarios->foto;
    

    $usuarios->update();

    //PARA MODIFICAR A LA TABLA USERS
    $user = User::find($id);
    if ($user !== null) {
        $user->name = $request->post('nombre');
        $user->email = $request->post('email');
        $user->password = $usuarios->password;
        $user->update();
    }

    //AMBAS TABLAS TIENEN UNA RELACIÓN 1 A 1

    /****LOGICA PARA AUDITORIAS****/
    $auditoria = new Auditoria();
    $auditoria->fecha_hora = now();
    $auditoria->usuario_id = Auth::id();
    $auditoria->accion = "Modificó un usuario";
    $usuarioResponsable = Usuarios::find(Auth::id());
    $auditoria->nombre_usuario = $usuarioResponsable->apellido . ', ' . $usuarioResponsable->nombre;
    $auditoria->save();

    return redirect()->route("usuarios.index")->with("success", "Usuario modificado con éxito.");
}

    
    public function destroy(Request $request, $id)
    {
        $verificacionID_SesionActual = Auth::id();

        if($verificacionID_SesionActual == $id){
            return redirect()->route("usuarios.index")->with("success", "No puede eliminar su propio usuario"); 
        }

        $usuarios = Usuarios::find($id);
        $user = User::find($id);

        //METODO PARA ELIMINAR
        $usuarios->delete();
        $user->delete();

          /****LOGICA PARA AUDITORIAS****/
          $auditoria = new Auditoria();
          $auditoria->fecha_hora = now();
          $auditoria->usuario_id = Auth::id();
          $auditoria->accion = "Eliminó un usuario";
          $usuarioResponsable = Usuarios::find(Auth::id());
          $auditoria->nombre_usuario = $usuarioResponsable->apellido . ', ' . $usuarioResponsable->nombre;   
          $auditoria->save();

        //PARA RETORNAR
        return redirect()->route("usuarios.index")->with("success", "Eliminado con éxito!");   
    }
}
