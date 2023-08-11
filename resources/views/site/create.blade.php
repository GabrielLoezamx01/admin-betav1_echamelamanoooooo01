<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EchameLaMano - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layouts.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        body,
        input,
        label,
        p,
        h1,
        h2,
        b,
        textarea,
        select,
        checkbox {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #FAFFFD;
        }

        .text-site {
            color: #249F11;
        }

        .btn-one {
            background-color: #342E37;
            color: #FAFFFD;
        }

        .efect {
            position: relative;
            margin-bottom: 1rem;
        }

        .efect input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #342E37;
            padding: 0.5rem;
            font-size: 1rem;
            outline: none;
        }

        .efect label {
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: top left;
            transform: translateY(1rem);
            font-size: 0.875rem;
            /* Ajusta el tamaño de la fuente según tus preferencias */
            color: #666;
            transition: transform 0.2s ease-out, font-size 0.2s ease-out, color 0.2s ease-out;
        }

        .efect input:focus+label,
        .efect input:not(:placeholder-shown)+label {
            transform: translateY(0);
            font-size: 0.75rem;
            /* Ajusta el tamaño de la fuente según tus preferencias */
            color: #333;
        }

        .efect input:not(:placeholder-shown)+label {
            transform: translateY(0);
            font-size: 1rem;
            /* Ajusta el tamaño de la fuente según tus preferencias */
            color: #333;
            padding-left: 0.5rem;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        .animated-h1 {
            animation: bounce 2s infinite;
        }

        .background-image {
            background-image: url('img/icon.jpg');
            background-size: cover;
            background-position: center;
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            opacity: 0.04;
            /* Cambia el valor para ajustar la opacidad */
            z-index: -1;
        }

        .custom-select:focus {
            border-color: #249F11;
            box-shadow: 0 0 0 0.25rem rgba(36, 159, 17, 0.25);
        }
    </style>
</head>

<body>
    <div class="background-image"></div>
    <main class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-xl-6 col-lg-6 p-5 order-md-1">
                <img src="svg/one.svg" class="img-fluid">
            </div>
            <div class="col-md-6 col-xs-6 col-lg-6  p-5 order-md-2">
                <h2 class="text-site fw-bold fs-1 animated-h1">EchameLaMano</h2>
                <div class="mt-5">
                </div>
                <form method="post" action="{{ route('crear_cliente') }}">
                    @csrf
                    <input type="hidden" name="rol" value="001">
                    {{-- <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3> --}}
                    <div class="efect mt-5">
                        <input type="email" name="email" id="email" autocomplete="off" placeholder=" "
                            value="{{ old('email') }}" class="mt-3" />
                        <label for="email">Correo</label>
                    </div>
                    <div class="efect mt-5">
                        <input type="password" name="password" autocomplete="off" placeholder=" " class="mt-3" />
                        <label class="form-label" for="form2Example28" value="{{ old('password') }}">Contraseña</label>
                    </div>

                    <div class="mb-3">
                        <label for="">Tipo de usuario:</label>
                        <select name="type_client" id="type_client" class="custom-focus form-control">
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
</body>

</html>
