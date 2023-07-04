<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/layouts.css">

</head>

<body>
    <main class="vh-100">
        <section class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-black">

                    <div class="px-5 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">Logo</span>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form style="width: 50rem;" method="post"action="{{ route('crear_cliente') }}">
                            @csrf
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Crear Usuario</h3>

                            <div class="mb-3">
                                <label for="">Correo:</label>
                                <input class="form-control custom-focus mt-3 form-control-lg" type="text"
                                    name="email" autocomplete="off" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="">Contraseña:</label>
                                <input class="form-control custom-focus mt-3 form-control-lg" type="password"
                                    name="password" id="p1" autocomplete="off" value="{{ old('password') }}">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="">Confirma Contraseña:</label>
                                <input class="form-control custom-focus mt-3 form-control-lg" type="password"
                                    name="password2" id="p2" autocomplete="off" value="{{ old('password2') }}">
                            </div> --}}
                            <div class="mb-3">
                                <label for="">Tipo de usuario:</label>
                                <select name="type_client" id="type_client" class="form-control custom-focus">
                                    <option value="type_one">Vendedor</option>
                                    <option value="type_two">Cliente</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-large btn-dark p-2">Crear</button>
                            </div>

                        </form>
                    </div>
                    <div class="mt-5 mb-4">
                        <a href="auth/google/register">
                            <div class="bg-white text-center p-2">
                                <button class="btn btn-white text-danger">
                                    Crear cuenta con
                                    <i class="fab fa-google me-2"></i>oogle
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 px-0 d-none d-sm-block">
                    <img src="img/icon.jpg" alt="Login image" class="w-100 vh-100"
                        style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </section>
    </main>

</body>

</html>
