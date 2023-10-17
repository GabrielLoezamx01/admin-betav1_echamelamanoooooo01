<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EchameLaMano - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/layouts.css">
    <link rel="stylesheet" href="css/site.css">
</head>

<body>
    <div class="background-image"></div>
    <main class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-xl-6 col-lg-6 p-5 order-md-1">
                <img src="svg/one.svg" class="img-fluid">
            </div>
            <div class="col-md-6 col-xs-6 col-lg-6 p-5 order-md-2">
                <h2 class="text-site fw-bold fs-1 animated-h1">EchameLaMano</h2>
                <div class="mt-5"></div>
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
                <p class="small mb-5 mt-5 pb-lg-2"><a class="text-muted" href="#!">¿Has olvidado tu contraseña?</a>
                </p>
                <div class="pt-1 mb-4 text-center mt-5">
                    {!! Form::submit('Vamos', ['class' => 'btn btn-one btn-large']) !!}
                </div>
                {{-- <div class="mt-5 mb-4">
                        <a href="auth/google">
                            <div class="bg-white text-center p-2">
                                <button class="btn btn-white text-danger">
                                    Iniciar sesión con
                                    <i class="fab fa-google me-2"></i>oogle
                                </button>
                            </div>
                        </a>
                    </div> --}}
                <p class="mt-5">¿No tienes una cuenta? <a href="crear_client" class="link-info">Registrar aquí</a></p>
                {!! Form::close() !!}
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script>
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('showPassword');

        eyeIcon.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        function cerrarAlerta() {
            const alerta = document.querySelector('.alert');
            alerta.style.display = 'none';
        }
    </script>
</body>

</html>
