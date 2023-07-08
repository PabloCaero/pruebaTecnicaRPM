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
        nav {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #c97e7e;
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
            color: #333;
        }

        .nav-links a:hover {
            color: #000;
        }

        .nav-links .labels {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .nav-links .labels span {
            margin-right: 5px;
            font-weight: bold;
        }

        @media screen and (max-width: 480px) {
            .logo-container {
                position: static;
                width: 60px;
                height: 60px;
                margin-right: 10px;
            }


        }

        .user-info {
            margin-left: 100px;
            font-size: 14px;
        }
        
    </style>
</head>
<body>
<nav>
    <div class="logo-container">
        <br><br>
        <img class="logo"
        @php
            use App\Models\Usuarios;
            $user = Usuarios::find(Auth::user()->id); 
        @endphp
        src="{{ asset($user->foto) }}"
        alt="Logo">

    </div>
    <div class="user-info">
        <strong>ID:</strong> {{ Auth::user()->id }}<br>
        <strong>Usuario/a:</strong> {{ $user->apellido.', '.$user->nombre }}
    </div>
    <ul class="nav-links"style="margin-left: auto;">
      
      <li><a href="{{ route('usuarios.index') }}" class="btn btn-info">
        <span class="fas fa-undo-alt"> </span> Inicio</a>

        <li><a href="{{ route('usuarios.create') }}" class="btn btn-success">
          <span class="fas fa-user-plus"> </span>
          <!--ICONO-->
          Agregar Nuevo Usuario</a></li>
        <li><a href="{{ route('auditoria.index') }}" class="btn btn-primary">
          <span class="fas fa-user-plus"> </span>
          <!--ICONO-->
          Auditorias</a></li>
        <li><a href="{{ route('logout') }}" class="btn btn-danger">
          <span class="fas fa-user-plus"> </span>
          <!--ICONO-->
          Salir</a></li>
        
    </ul>
</nav>


</html>
<div class="container">
    <br><br>




    @yield('contenido')
    <!-- CONTENIDO-->

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


</body>

</html>
