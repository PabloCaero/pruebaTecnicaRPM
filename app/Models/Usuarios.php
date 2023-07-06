<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class Usuarios extends Model
{
    use HasFactory;

    //PARA ESTABLECER UNA RELACIÓN 1 A 1
    public function user()
    {
    return $this->hasOne(User::class);
    }

}