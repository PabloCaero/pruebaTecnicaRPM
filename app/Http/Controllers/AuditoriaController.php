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

    
   
    public function store(Request $request)
    {
        //
    }

   
}
