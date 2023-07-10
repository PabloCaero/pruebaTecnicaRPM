
# RPM Consumer Group - Ejercicio práctico de nivelación 👋

El ejercicio se debe entregar con plazo máximo el **Martes 11 de Julio 18:00hs**.



## Objetivo

Crear en Laravel un portal web tipo BackEnd que tenga permita crear usuarios y utilizarlos si están activos para loguearse.
Al loguearse o utilizar el CRUD, debe guardar auditoria de la acción en la tabla de auditoria detallando la acción realizada. 



## Características deseadas

- **Login**
usando email como usuario y clave alfanumérica (16 digitos requeridos)

- **CRUD de Usuarios**
Nombre, Apellido, Email, Estado (Activo-Inactivo), Upload de Foto, Visualización de Foto subida. 

- **Visualización de Auditoria**
Datatable para visualización de la información guardada

- **Logout**


## Base de Datos

Motor de Datos a Utilizar: **MySQL**

- Crear tabla de Usuarios
No debe guardar la contraseña plana

- Crear Tabla de Auditoria
Debe guardar fecha y hora, id del usuario, accion (login, modificacion/creacion/eliminacion de usuario, logout)




## Consideraciones
- Debe tener usuario **administrador@rustoleum.com.ar**, clave **Z!eVr6ang$_fgGP?** activo y listo para su uso.
- Usuarios y Auditoria deben ser accesibles únicamente estando autenticados.
- Las tablas deben alimentar los campos created_at, updated_at y deleted_at según corresponda.
- Debe incluir las database migrations de Laravel para poder recrear la base de datos localmente en mi computadora.
- Subir el proyecto y el **Readme.md** a un repositorio en GitHub personal y enviar la URL a **carlos.castro@rustoleum.com.ar**.





## Contacto

Cualquier duda escribime a carlos.castro@rustoleum.com.ar


## Exitos con el ejercicio!! 💪😎


## Notas de Pablo Caero:

/*****Comandos a ejecutar en la terminal*****/

$ composer install
$ php artisan migrate
$ php artisan db:seed
$ php artisan storage:link
$ php artisan serve

/*****Configuración de la base de datos en .env*****/

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DB_pruebaTecnicaRPM
DB_USERNAME=root
DB_PASSWORD=

/*****Credenciales para inicio de sesión*****/

Usuario: administrador@rustoleum.com.ar
Clave: Z!eVr6ang$_fgGP?





