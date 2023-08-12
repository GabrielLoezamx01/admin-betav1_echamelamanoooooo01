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
    {{-- <link rel="stylesheet" href="css/layouts.css"> --}}
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
        body {
            background-color: #FAFFFD;
        }
        body,
        input,
        label,
        p,
        b,
        textarea,
        select,
        checkbox {
            font-family: 'Poppins', sans-serif;
        }
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Poppins", sans-serif;
        }

        .bg-primaryechame {
            background-color: #249f11;
        }

        .bg-primary>div>ul>li>a {
            color: white;
        }

        .centered-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
            background-color: #ffffff;
        }

        .navbar-custom {
            padding: 5px;
            background-color: #249f11;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav .nav-link {
            color: white;
        }

        .navbar-custom .navbar-nav .nav-item {
            margin-right: 15px;
        }

        @media (max-width: 767px) {
            .navbar-custom .navbar-nav .nav-item {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        .footer-custom {
            background-color: #343a40;
            color: white;
            padding: 50px 0;
        }

        .footer-custom a {
            color: white;
            text-decoration: none;
        }

        .card-custom {
            border: none;
        }

        .text-title {
            color: #656666;
        }

        .form-control.custom-focus:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .card {
            padding: 20px;
            margin-bottom: 20px;
        }

        .card .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .card .post-content {
            margin-top: 10px;
        }

        .card .post-actions {
            margin-top: 15px;
        }

        .card .post-date {
            font-size: 14px;
            color: #888;
        }

        .card .post-actions .btn {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .card .verification-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            margin-left: 5px;
        }

        .verified {
            background-color: green;
            color: white;
        }

        .not-verified {
            background-color: red;
            color: white;
        }

        .select-option:hover {
            background-color: #656666;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {

            /* Estilos responsivos para pantallas pequeñas */
            .card .post-actions .btn {
                margin-bottom: 0;
            }
        }

        .btn-minimalista {
            background-color: #fff;
            color: #000;
            border: 2px solid transparent;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: background-color 0.3s ease, color 0.3s ease,
                border-color 0.3s ease;
            cursor: pointer;
            border-radius: 0;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            outline: none;
        }

        .btn-minimalista:hover {
            background-color: #249f11;
            color: #fff;
            border-color: #249f11;
        }

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

        /* Estilo para todos los enlaces dentro del navbar */
        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            font-weight: 400;
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
            color: #019e0f;

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
            background-color: #dcf8c6;
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
            border-right: 10px solid #dcf8c6;
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
            height: 100px;
            object-fit: cover;
            /* Puedes usar 'cover', 'contain', 'fill', etc., según tus necesidades */
        }

        .imagen-contenido {
            position: relative;
            overflow: hidden;
        }

        .imagen {
            width: 100%;
            /* Tamaño de la imagen */
            height: 200px;
            /* Tamaño de la imagen */
            object-fit: cover;
            /* Ajustar imagen al tamaño del contenedor */
            transition: transform 0.3s ease;
        }

        .title-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.7);
            /* Color del fondo del título */
            color: #fff;
            /* Color del texto del título */
            padding: 10px;
            width: 100%;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .imagen-contenido:hover .image {
            transform: scale(1.1);
            /* Efecto de escala en hover */
        }

        .imagen-contenido:hover .title-overlay {
            transform: translateY(0);
            /* Mostrar el título en hover */
        }

        .online-dot {
            width: 10px;
            height: 10px;
            background-color: #4caf50;
            /* Color verde */
            border-radius: 50%;
            /* Para hacer un círculo */
            display: inline-block;
            margin-right: 5px;
            /* Espacio entre el punto y el texto */
        }

        .offline-dot {
            width: 10px;
            height: 10px;
            background-color: #ff0000;
            /* Color rojo */
            border-radius: 50%;
            /* Para hacer un círculo */
            display: inline-block;
            margin-right: 5px;
            /* Espacio entre el punto y el texto */
        }
        .profile-image-container {
            text-align: center; /* Centrar la imagen horizontalmente */
            margin-bottom: 1rem; /* Espacio inferior */
        }

        .profile-image-container img {
            max-width: 100%;
            border: 10px solid #4caf50; /* Agregar un borde blanco */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); /* Agregar sombra */
        }

        .publicaciones:hover {
      transform: scale(1.1);
      transition: transform 0.3s ease;
         }
    </style>
</head>

<body>
    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="Bienvenido">

                    <img src="img/logo.png" class="img-fluid" style="width: 50%">
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
    <main class="container" style="margin-top: 200px">
        @yield('content')
    </main>
    <div style="margin-top: 200px">
    </div>
    <footer class="footer-custom footer  p-3" style="background-color: #342E37">
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
