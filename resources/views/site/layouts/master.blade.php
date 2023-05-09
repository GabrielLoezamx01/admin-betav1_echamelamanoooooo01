<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.22/dist/css/uikit.min.css" />
    <style>
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
            /* ajusta la altura según tu diseño */
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <nav class="uk-padding-small bg-primary" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li class="uk-nav"><a href="Bienvenido">Publicaciones</a></li>
                <li><a href="soporte_clients">Soporte</a></li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li class="uk-nav"><a href="#"> <b>{{ session('name') }} </b> </a></li>
                <li class="uk-nav"><a href="profle_clients">Mi Perfil</a></li>
                <li class="uk-nav"><a href="close_session">Salir</a></li>
            </ul>
        </div>
    </nav>
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.6.22/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.6.22/js/uikit-icons.min.js"></script>
    <script src="vue/vue.js"></script>
    <script src="vue/resource.js"></script>
    @stack('child-scripts')
</body>

</html>
