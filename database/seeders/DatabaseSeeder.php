<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Usuarios;

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
         $user->password = bcrypt('Z!eVr6ang$_fgGP?');
         $user->save();
 
         
         $usuario = new Usuarios();
         $usuario->nombre = 'Administrador';
         $usuario->apellido = 'Administrador';
         $usuario->email = 'administrador@rustoleum.com.ar';
         $usuario->password = bcrypt('Z!eVr6ang$_fgGP?');
         $usuario->estado = 'Activo';
         $usuario->foto = 'imagen.jpg';
         $usuario->save();
    }
}
