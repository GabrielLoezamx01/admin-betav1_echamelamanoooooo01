<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EchameLaMano - Inicia sesión en tu cuenta">
    <meta name="keywords" content="echamelamano, inicio de sesión, cuenta, seguridad">
    <meta name="author" content="Tu Nombre">

    <title>EchameLaMano - Inicia Sesión</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/layouts.css">
    <link rel="stylesheet" href="css/site.css">
</head>
<body>
    <div class="background-image"></div>
    <main class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-xl-6 col-lg-6 p-5 order-md-1">
                <img src="svg/one.svg" class="img-fluid" alt="Imagen de inicio de sesión">
            </div>
            <div class="col-md-6 col-xs-6 col-lg-6 p-5 order-md-2">
                <h2 class="text-site fw-bold fs-1 animated-h1">EchameLaMano</h2>

                {!! Form::open(['route' => 'login_client']) !!}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <span class="close-btn" onclick="cerrarAlerta()">&times;</span>
                        <h2>¡Ocurrió un problema!</h2>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="efect mt-5 col-11 mt-5">
                    {!! Form::email('email', old('email'), ['id' => 'email', 'autocomplete' => 'off', 'placeholder' => ' ', 'class' => 'mt-3']) !!}
                    {!! Form::label('email', 'Correo') !!}
                </div>

                <div class="efect password-input col-11 mt-5">
                    {!! Form::password('password', ['id' => 'password', 'required', 'placeholder' => '', 'class' => 'mt-3']) !!}
                    {!! Form::label('password', 'Contraseña', ['class' => 'p-1']) !!}
                    <button id="showPassword" type="button"><i class="far fa-eye"></i></button>
                </div>

                <p class="small mb-5 mt-5 pb-lg-2"><a class="text-muted" href="#!">¿Has olvidado tu contraseña?</a></p>

                <div class="pt-1 mb-4 text-center mt-5">
                    {!! Form::submit('Vamos', ['class' => 'btn btn-one btn-large']) !!}
                </div>

                <p class="mt-5">¿No tienes una cuenta? <a href="crear_client" class="link-info">Registrar aquí</a></p>
                {!! Form::close() !!}
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
</body>
</html>
