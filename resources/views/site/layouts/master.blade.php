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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/layouts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .sidebar {
            background-color: white;
            color: black;
            padding: 15px;
            position: relative;
            height: 100%;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            color: black;
            text-decoration: none;
        }

        .sub-menu {
            display: none;
        }

        .sub-menu.open {
            display: block;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* Elimina las rayas subrayadas de los enlaces */
        a:hover,
        a:active {
            color: #249f11;
            /* text-decoration: none; */
        }

        .notification {
            background-color: #f6f7f9;
            padding: 10px;
            border: 1px solid #dddfe2;
            border-radius: 5px;
        }

        .notification .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .notification .content {
            display: flex;
            align-items: center;
        }

        .notification .message {
            font-weight: 500;
        }

        .notification .timestamp {
            font-size: 12px;
            color: #999;
        }
    </style>
    <style>
        /* Estilo para todos los enlaces dentro del navbar */
        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            font-weight: 700;
            /* Color del texto de los enlaces */
            position: relative;
            /* Asegura que el elemento padre (.nav-link) sea un contenedor para el pseudo-elemento */
        }

        /* Efecto hover para el círculo de fondo blanco */
        .navbar-custom .navbar-nav .nav-link::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            border-radius: 10px;
            background-color: #fff;
            color: #019E0F;

            opacity: 0;
            transition: width 0.3s ease, height 0.3s ease, opacity 0.3s ease;
        }

        .navbar-custom .navbar-nav .nav-link:hover::before {
            width: 100%;
            /* Tamaño del círculo */
            height: 80%;
            /* Tamaño del círculo */
            opacity: 0.4;
            /* Opacidad del círculo */
        }

        /* Cambiar el color del texto al aplicar el efecto hover */
        .navbar-custom .navbar-nav .nav-link:hover {
            color: black;
            /* Color del texto al aplicar hover */
        }

        .chat-bubble {
            position: relative;
            background-color: #DCF8C6;
            color: #000;
            border-radius: 20px;
            padding: 10px 15px;
            max-width: 80%;
            margin-bottom: 10px;
        }

        .tail {
            position: absolute;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 10px solid #DCF8C6;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .message {
            margin: 0;
        }

        .rating {
            margin-bottom: 20px;
        }

        .stars {
            font-size: 20px;
            color: gold;
            display: inline-block;
        }

        /* Estilos para cambiar el color de las estrellas desactivadas */
        .stars::before {
            color: lightgray;
            position: absolute;
        }

        .stars::after {
            content: "";
            color: gold;
            width: 0;
            overflow: hidden;
        }

        .fija-img {
            width: 100%;
            height: 50%;
            object-fit: cover;
            /* Puedes usar 'cover', 'contain', 'fill', etc., según tus necesidades */
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom ">
            <div class="container">
                <a class="navbar-brand fw-bold" href="Bienvenido">

                    <img src="img/logo.png" class="img-fluid w-50">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @if (session('type_user') == 'V')
                            <li class="nav-item  ">
                                <a class="nav-link fw-bold" href="Bienvenido">Publicaciones</a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link fw-bold" href="mis_sucursales">Mis Sucursales</a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link fw-bold" href="mensajes_vendedor">Mensajes</a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link fw-bold" href="notificaciones_vendedor">Notificaciones</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link fw-bold" href="profile">Perfil</a>
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
    <main class="container mt-5">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script src="vue/vue.js"></script>
    <script src="vue/resource.js"></script>
    @stack('child-scripts')
</body>

</html>
