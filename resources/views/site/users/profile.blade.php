@extends('site.layouts.master')
@section('title', 'Perfil')
@push('styles')
    <style>

    </style>
@endpush
@section('content')
    <div class="container mt-5">
        <div class="row shadow rounded-3 ">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="mt-5 fs-3" style="color: #249f11">
                        ¡Gracias por registrarte <i style="color: #249f11" class="fas fa-thumbs-up"></i> !
                    </h1>
                </div>
            </div>
            <div class="col-md-12">
                @if (session('name') == '' or session('photo') == '')
                <div class="m-4">
                    <label for="informacion">Completa tus datos para finalizar.</label>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="" method="post" action="{{ route('data_clients') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="m-3 mt-5">
                        <label for="intruccion 1" class="fw-bold">Información personal.</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-5">
                                <div class="mb-3">
                                    <label for="userName">Nombre de usuario:</label>
                                    <input class="mt-3 form-control custom-focus" type="text" id="userName"
                                        name="userName"  required autocomplete="off" maxlength="10"
                                        oninput="eliminarEspacios(event)" value="{{old('userName')}}" required >
                                </div>

                                <div class="mb-3">
                                    <label for="nombre">Nombres:</label>
                                    <input class="mt-3 form-control custom-focus" type="text" id="nombre" value="{{ old('nombre') }}"
                                        name="nombre" required>
                                </div>

                                <div class="mb-3">
                                    <label for="apellidos">Apellidos:</label>
                                    <input class="mt-3 form-control custom-focus" type="text" id="apellidos" value="{{old('apellidos')}}"
                                        name="apellidos">
                                </div>

                                <div class="mb-3">
                                    <label for="telefono">Teléfono:</label>
                                    <input class="mt-3 form-control custom-focus" type="tel" id="telefono" autocomplete="off" value="{{old('telefono')}}"
                                        name="telefono"  required maxlength="12"
                                        pattern="\d{1,12}" value="{{ old('telefono') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-5">
                                <div class="mb-3">
                                    <label for="foto">Foto de perfil:</label>
                                    <input type="file" id="foto" name="foto"
                                        class="mt-3 form-control custom-focus" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="m-3 mt-5">
                        <label for="intruccion 1" class="fw-bold">Dirección.    </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-5">
                                <div class="mb-3">
                                    <label for="postal">Codigo Postal:</label>
                                    <input class="mt-3 form-control custom-focus" type="text" id="postal"
                                        name="postal" required value="{{old('postal')}}"
                                        value="{{ old('postal') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="estado">Estado:</label>
                                    <input class="mt-3 form-control custom-focus" type="text" id="estado"
                                        name="estado"  required value="{{old('estado')}}">
                                </div>
                                <div class="mb-3">
                                    <label for="ciudad">Ciudad:</label>
                                    <input class="mt-3 form-control custom-focus" type="text" id="ciudad"
                                        name="ciudad" required value="{{ old('ciudad') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="direccion">Dirección:</label>
                                    <input type="text" id="direccion" value="{{old('direccion')}}" name="direccion" class="mt-3 form-control custom-focus" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="text-center mt-5">
                            <button class="btn btn-dark" type="submit">Enviar</button>
                        </div>
                    </div>
                </form>
            @endif
            </div>
        </div>
    </div>
@endsection
@push('child-scripts')
    <script>
        function eliminarEspacios(event) {
            var input = event.target;
            input.value = input.value.replace(/\s/g, '');
        }
    </script>
@endpush
