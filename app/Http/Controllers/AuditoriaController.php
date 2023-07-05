<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    
    public function index()
    {
        $datos =  Auditoria::orderBy('id', 'desc')->paginate(3);

        return view('auditoria', compact('datos')); //ENTRE COMILLAS SIMPLES
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(Auditoria $auditoria)
    {
        //
    }

   
    public function edit(Auditoria $auditoria)
    {
        //
    }

    
    public function update(Request $request, Auditoria $auditoria)
    {
        //
    }

   
    public function destroy(Auditoria $auditoria)
    {
        //
    }
}
