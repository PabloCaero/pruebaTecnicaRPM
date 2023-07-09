<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    
    public function index()
    {
        $datos =  Auditoria::orderBy('id', 'desc')->paginate(10);

        return view('auditoria', compact('datos')); //ENTRE COMILLAS SIMPLES
    }

    public function buscar(Request $request)
{
    $searchTerm = $request->input('search');

    // Realizar la lógica de búsqueda en la tabla de auditorías
    $datos = Auditoria::where('fecha_hora', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('usuario_id', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('nombre_usuario', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('accion', 'LIKE', '%' . $searchTerm . '%')
        ->paginate(10);

    return view('auditoria', compact('datos'));
}


    
   
    public function store(Request $request)
    {
        //
    }

   
}
