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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/aos@3.0.0-beta.6/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/layouts.css">
    @stack('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css" rel="stylesheet">

</head>

<body>
    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="Bienvenido">
                    <img src="img/icon.jpg" class="img-fluid" style="width: 50px">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @if (session('type_user') == 'V')
                            <li class="nav-item  ">
                                <a class="nav-link" href="Bienvenido">Publicaciones</a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link" href="mis_sucursales">Mis Sucursales</a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link" href="mensajes_vendedor">Mensajes</a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link" href="notificaciones_vendedor">Notificaciones</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="profile">Perfil</a>
                            </li>
                        @endif
                        @if (session('type_user') == 'C')
                            <li class="nav-item ">
                                <a class="nav-link" href="profile">Perfil</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="Bienvenido">Publicaciones</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="list_Sucursales">Sucursales</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="mis_servicios">Servicios</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="notificaciones_cliente">Notificaciones</a>
                            </li>
                        @endif

                    </ul>
                    <ul class="navbar-nav mr-auto ">
                        <li class="nav-item">
                            <a class="nav-link" href="close_session">Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid" style="margin-top: 100px">
        @yield('content')
    </main>
    <div style="margin-top: 200px">
    </div>
    <footer class="footer-custom footer  p-3 bg-dark shadow">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script src="vue/vue.js"></script>
    <script src="vue/resource.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@3.0.0-beta.6/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>

    <script>
        AOS.init({
            duration: 1000, // Duración de la animación en milisegundos
            once: false, // Animar cada vez que se desplaza
        });
    </script>
    @stack('child-scripts')
</body>

</html>