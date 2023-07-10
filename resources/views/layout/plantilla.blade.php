<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- DEPENDENCIAS DE BOOTSTRAP Y FONTAWESOME -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <title>@yield('tituloPagina')</title> <!-- TITULO DE PÁGINA -->

    <style>
        .estado-activo {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background-color: #8cf5a5;
            /* Verde claro */
        }

        .estado-inactivo {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background-color: #f8868f;
            /* Rojo claro */
        }

        body {
            background-color: #ffc7c7; /* Gris claro */
        }


        nav {
           
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            position: absolute;
            top: -40px;
            left: 10px;
            z-index: 1;
        }

        .logo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #212529; 
        }

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .nav-links li {
            margin-left: 10px;
            margin-top: 1px;
            margin-bottom: -12px;
        }

        .nav-links a {
            text-decoration: none;
            color: #fff; /* Color del texto del enlace */
        }

        .nav-links a:hover {
            color: #ccc; /* Color del texto del enlace al pasar el mouse */
        }

        .user-info {
            margin-left: 100px;
            font-size: 14px;
            color: #fff; /* Color del texto de la información del usuario */
        }

        footer {
            background-color: #212529; /* Negro */ 
            padding: 20px 0;
            color: #fff; /* Color del texto del footer */
            text-align: center;
        }

        footer a {
            color: #fff; /* Color del texto del enlace del footer */
        }

        footer a:hover {
            color: #ccc; /* Color del texto del enlace del footer al pasar el mouse */
        }



        .user-info {
            margin-left: 100px;
            font-size: 14px;
        }
        
        .user-info {
            margin-left: 100px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <nav style=" background-color: #212529; /* Negro */">
        <div class="logo-container">
            <br><br>
            <img class="logo"
                @php
                    use App\Models\Usuarios;
                    $user = Usuarios::find(Auth::user()->id);
                @endphp
                src="{{ asset($user->foto) }}" alt="Logo">
        </div>
        <div class="user-info">
            <strong>ID:</strong> {{ Auth::user()->id }}<br>
            <strong>Usuario/a:</strong> {{ $user->apellido . ', ' . $user->nombre }}
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                    <span class="fas fa-home"> </span> Inicio</a></li>
            <li><a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                    <span class="fas fa-user-plus"> </span> Agregar Nuevo Usuario</a></li>
            <li><a href="{{ route('auditoria.index') }}" class="btn btn-primary">
                    <span class="fas fa-list-ul"> </span> Auditorias</a></li>
            <li><a href="{{ route('logout') }}" class="btn btn-danger">
                    <span class="fas fa-sign-out-alt"> </span> Cerrar Sesión</a></li>
        </ul>
    </nav>

    <div class="container">
        <br><br>
        @yield('contenido')
        <!-- CONTENIDO -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <a href="https://github.com/PabloCaero" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/pabloecaero" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/pabloecaero" target="_blank"><i class="fab fa-instagram"></i></a>
                    <br>
                    <p>© 2023 Pablo Ezequiel Caero <br> RPM Consumer Group - Ejercicio práctico de nivelación</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
