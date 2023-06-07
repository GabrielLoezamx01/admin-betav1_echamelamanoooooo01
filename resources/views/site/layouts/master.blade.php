<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/layouts.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom ">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/Bienvenido">{{ env('name_site') }}</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Bienvenido">Publicaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ajustes</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mr-auto ">
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ session('name') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="close_session">Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid mt-5">
        @yield('content')
    </main>
    <footer class="footer-custom">
        <div class="container text-center">
            <p>
                <a href="#contacto">Contactanos</a> |
                <a href="#soporte">Soporte</a> |
                <a href="#quienes-somos">Quienes Somos</a>
            </p>
            <p>&copy; 2023 Mi Sitio Web. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="vue/vue.js"></script>
    <script src="vue/resource.js"></script>
    @stack('child-scripts')
</body>

</html>
