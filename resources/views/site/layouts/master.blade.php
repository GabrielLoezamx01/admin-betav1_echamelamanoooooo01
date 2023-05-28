<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.22/dist/css/uikit.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            /* font-family: 'Open Sans', sans-serif; */
            font-family: 'Poppins', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Poppins', sans-serif;
        }

        .bg-primary {
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
            padding: 40px;
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
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
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
    </style>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.6.22/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.6.22/js/uikit-icons.min.js"></script>
    <script src="vue/vue.js"></script>
    <script src="vue/resource.js"></script>
    @stack('child-scripts')
</body>

</html>
