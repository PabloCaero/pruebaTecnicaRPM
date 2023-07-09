<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Usuarios;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         
         $user = new User();
         $user->name = 'Administrador';
         $user->email = 'administrador@rustoleum.com.ar';
         $user->password = Hash::make('Z!eVr6ang$_fgGP?');
         $user->save();
 
         
         $usuario = new Usuarios();
         $usuario->nombre = 'Administrador';
         $usuario->apellido = 'Administrador';
         $usuario->email = 'administrador@rustoleum.com.ar';
         $usuario->password = Hash::make('Z!eVr6ang$_fgGP?');
         $usuario->estado = 'Activo';
         $usuario->foto = 'logo.png';
         $usuario->save();

         /****LOGICA PARA AUDITORIAS****/
         $auditoria = new Auditoria();
         $auditoria->fecha_hora = now();
         $auditoria->usuario_id = 1;
         $auditoria->accion = 'Generación automática de Administrador';
         $auditoria->nombre_usuario = 'Administrador, Administrador';   
         $auditoria->save();
    }
}
