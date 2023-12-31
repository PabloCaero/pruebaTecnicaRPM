<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\User;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    
    
    public function index()
    {
      
        $datos =  Usuarios::orderBy('id', 'asc')->paginate(6);

        return view('inicio', compact('datos')); //ENTRE COMILLAS SIMPLES
    }

    public function buscar(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Realizar la lógica de búsqueda en la tabla de auditorías
        $datos = Usuarios::where('nombre', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('apellido', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('id', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('estado', 'LIKE', '%' . $searchTerm . '%')
            ->paginate(6);
    
        return view('inicio', compact('datos'));
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

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|alpha_num|min:16',
        ], [
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.string' => 'El campo de contraseña debe ser una cadena de texto.',
            'password.alpha_num' => 'El campo de contraseña solo puede contener caracteres alfanuméricos.',
            'password.min' => 'El campo de contraseña debe tener al menos 16 caracteres.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


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
            return redirect()->route("usuarios.index")->with("success", "No se pudo agregar. El correo electrónico ".$email." ya está registrado");
        }
    
        $usuarios = new Usuarios();
        $usuarios->nombre = $request->post('nombre');
        $usuarios->apellido = $request->post('apellido');
        $usuarios->email = $email;
        $usuarios->password = Hash::make($request->post('password')); //LO GUARDA EN FORMA CIFRADA
        $usuarios->estado = $request->post('estado');
        $usuarios->foto = $ruta ? Storage::url($ruta) : 'sinfoto.png';
    
        $usuarios->save();
    
        //PARA AGREGAR A LA TABLA USERS
        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
    
        $user->save();
    
        //AMBAS TABLAS TIENEN UNA RELACIÓN 1 A 1

        $datosAuditados = Usuarios::where('email', $email)->first();
    
        /****LOGICA PARA AUDITORIAS****/
        $auditoria = new Auditoria();
        $auditoria->fecha_hora = now();
        $auditoria->usuario_id = Auth::id();
        $auditoria->accion = "Agregó a usuario ID: #".$datosAuditados->id." - ".$datosAuditados->apellido.", ".$datosAuditados->nombre;
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
    $validator = Validator::make($request->all(), [
        'password' => 'nullable|string|alpha_num|min:16',
    ], [
        'password.string' => 'El campo de contraseña debe ser una cadena de texto.',
        'password.alpha_num' => 'El campo de contraseña solo puede contener caracteres alfanuméricos.',
        'password.min' => 'El campo de contraseña debe tener al menos 16 caracteres.',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    
    
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
        return redirect()->route("usuarios.index")->with("success", "No se pudo modificar, el correo electrónico ".$request->post('email')." ya está registrado en otro usuario");
    }

    //PARA TOMAR DATOS DEL FORMULARIO
    $usuarios->nombre = $request->post('nombre');
    $usuarios->apellido = $request->post('apellido');
    $usuarios->email = $request->post('email');
    
    $passwordNuevo = $request->post('password');
   if ($passwordNuevo == "") {
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
        if ($passwordNuevo == "") {
            //LA CONTRASEÑA NO SE MODIFICA
        } else {         
            $user->password = Hash::make($passwordNuevo);
        }
        $user->update();
    }

    //AMBAS TABLAS TIENEN UNA RELACIÓN 1 A 1
    $datosAuditados = Usuarios::find($id);

    /****LOGICA PARA AUDITORIAS****/
    $auditoria = new Auditoria();
    $auditoria->fecha_hora = now();
    $auditoria->usuario_id = Auth::id();
    $auditoria->accion = "Modificó a usuario ID: #".$datosAuditados->id." - ".$datosAuditados->apellido.", ".$datosAuditados->nombre;
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

        /****LOGICA PARA AUDITORIAS****/
        $auditoria = new Auditoria();
        $auditoria->fecha_hora = now();
        $auditoria->usuario_id = Auth::id();
        $auditoria->accion = "Eliminó a usuario ID: #".$id." - ".$usuarios->apellido.", ".$usuarios->nombre;
        $usuarioResponsable = Usuarios::find(Auth::id());
        $auditoria->nombre_usuario = $usuarioResponsable->apellido . ', ' . $usuarioResponsable->nombre;   
        $auditoria->save();

        //METODO PARA ELIMINAR
        $usuarios->delete();
        $user->delete();


        //PARA RETORNAR
        return redirect()->route("usuarios.index")->with("success", "Eliminado con éxito.");   
    }
}
