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

    <title>Login</title> <!-- TITULO DE PÁGINA -->
    
    <style>

body {
            background-color: #ffc7c7; /* Gris claro */
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

        .container-sm {
            max-width: 900px;
        }

        .navbar {
            background-color: #212529; /* Negro */
        }

        .navbar-brand {
            color: #fff; /* Color del texto de la marca en el navbar */
        }

        .navbar-brand:hover {
            color: #ccc; /* Color del texto de la marca en el navbar al pasar el mouse */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand " href="#">
                <h4>RPM Consumer Group - Ejercicio Práctico de Nivelación</h4>
            </a>
        </div>
    </nav>
    
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="container container-sm">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="logo.png" class="img-fluid rounded-start" style="width: 200px;" alt="logo">
                            </div>
                            <h5 class="card-header d-flex justify-content-center" style="color: #fff; background-color: #212529;">Login</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('inicia-sesion') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <div>
                                        <input type="checkbox" name="remember" id="remember">
                                        <label for="remember">Mantener sesión iniciada</label>
                                    </div>
                                  

                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @if ($mensaje = Session::get('success'))
                                                    <!--SI MENSAJE ESTA DEFINIDO-->
                                                    <div class="alert alert-success" role="alert">
                                                        {{ $mensaje }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br>


                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <button type="submit" class="btn btn-lg btn-primary"> <span class="fas fa-sign-in-alt"></span> Iniciar Sesión</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>


</html>
