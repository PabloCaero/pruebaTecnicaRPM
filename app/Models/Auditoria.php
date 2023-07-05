<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria'; //LE PONGO NOMBRE A LA TABLA, POR CONVENCION LARAVEL LAS BUSCA EN PLURAL
    use HasFactory;
}
