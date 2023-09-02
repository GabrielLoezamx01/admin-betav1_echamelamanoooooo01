    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>EchameLaMano - Crear Usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/site.css">
    </head>

    <body>
        <div class="background-image"></div>
        <main class="container mt-5">
            <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-md-6 col-xl-6 col-lg-6 p-5 order-md-1">
                    <img src="svg/one.svg" class="img-fluid">
                </div>
                <div class="col-md-6 col-xs-6 col-lg-6  p-5 order-md-2">
                    <div class="d-flex">
                        <h2 class="text-site fw-bold fs-1 animated-h1">EchameLaMano</h2>
                        <a href="{{ url()->previous() }}" class="btn btn-white m-2">
                            <i class="fas fa fa-arrow-left" title="regresar"></i>
                        </a>
                    </div>
                    <div class="mt-5">
                    </div>
                    <form method="post" action="{{ route('crear_cliente') }}">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <span class="close-btn" onclick="cerrarAlerta()">&times;</span>
                                <h2>¡Ocurrió un problema!</h2>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        @csrf
                        <input type="hidden" name="rol" value="001">
                        {{-- <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3> --}}
                        <div class="efect mt-5 col-11">
                            <input type="email" name="email" id="email" autocomplete="off" placeholder=" "
                                value="{{ old('email') }}" class="mt-3" />
                            <label for="email">Correo</label>
                        </div>
                        <div class="efect password-input col-11 mt-5">
                            <input type="password" id="password" name="password" required placeholder="" class="mt-3" >
                            <label for="password" class="p-1">Contraseña</label>
                            <button id="showPassword" type="button"><i class="far fa-eye"></i></button>
                        </div>
                        <div class="efect password-input col-11 mt-5">
                            <input type="password" id="confirm" name="confirm" required placeholder="" class="mt-3">
                            <label for="confirm" class="p-1">Confirmar Contraseña</label>
                            <button id="showconfirm" type="button"><i class="far fa-eye"></i></button>
                        </div>
                        <div class="mb-3">
                            <label for="type_client">Tipo de usuario:</label>
                            <select name="type_client" id="type_client" class="select-login">
                                <option value="type_one">Vendedor</option>
                                <option value="type_two">Cliente</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-large btn-dark p-2">Crear</button>
                        </div>

                    </form>
                </div>

            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
        <script>
            const passwordField = document.getElementById('password');
            const eyeIcon       = document.getElementById('showPassword');
            eyeIcon.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                } else {
                    passwordField.type = 'password';
                }

            });
            const confirm        = document.getElementById('confirm');
            const btn            = document.getElementById('showconfirm')
            btn.addEventListener('click', function() {
                if (confirm.type === 'password') {
                    confirm.type = 'text';
                } else {
                    confirm.type = 'password';
                }
            });
            function cerrarAlerta() {
                const alerta = document.querySelector('.alert');
                alerta.style.display = 'none';
            }
        </script>
    </body>

    </html>
