<!DOCTYPE html>
<html>

<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/layouts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">

                    <div class="px-5 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">Logo</span>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 50rem;" method="post" action="{{ route('login_client') }}">
                            @csrf
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                            <div class="form-outline mb-4">
                                <input type="email" name="email"
                                    class="form-control custom-focus form-control-lg" />
                                <label class="form-label" for="form2Example18">Correo</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password"
                                    class="form-control custom-focus form-control-lg" />
                                <label class="form-label" for="form2Example28">Contraseña</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-dark btn-lg btn-block">OK</button>
                            </div>


                        </form>

                    </div>
                    <div class="mt-5 mb-4">
                        <a href="auth/google">
                            <div class="bg-white text-center p-2">
                                <button class="btn btn-white text-danger">
                                    Iniciar sesión con
                                    <i class="fab fa-google me-2"></i>oogle
                                </button>
                            </div>
                        </a>
                    </div>

                    <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">¿Has olvidado tu
                        contraseña?
                    </a></p>
                <p>¿No tienes una cuenta? <a href="crear_client" class="link-info">Registrar aquí</a></p>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="img/icon.jpg" alt="Login image" class="w-100 vh-100"
                        style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
</body>

</html>
