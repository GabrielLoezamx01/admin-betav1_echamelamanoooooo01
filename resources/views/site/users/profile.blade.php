@extends('site.layouts.master')
@section('title', 'Perfil')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="p-5">
                        @if (session('name') == '' or session('photo') == '')
                            <p class="fw-bold fs-4">Importante a completar sus datos</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="form-control" method="post" action="{{ route('data_clients') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="p-3">
                                    <div class="mb-3">
                                        <label for="userName" class="fw-bold">Nombre de usuario:</label>
                                        <input class="mt-3 form-control custom-focus" type="text" id="userName"
                                            name="userName" placeholder="Ingrese su Nombre de usuario" required
                                            value="{{ old('userName') }}"  oninput="eliminarEspacios(event)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nombre" class="fw-bold">Nombres:</label>
                                        <input class="mt-3 form-control custom-focus" type="text" id="nombre"
                                            name="nombre" placeholder="Ingrese sus nombres" required
                                            value="{{ old('nombre') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellidos" class="fw-bold">Apellidos:</label>
                                        <input class="mt-3 form-control custom-focus" type="text" id="apellidos"
                                            name="apellidos" placeholder="Ingrese sus apellidos" required
                                            value="{{ old('apellidos') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="fw-bold">Teléfono:</label>
                                        <input class="mt-3 form-control custom-focus" type="tel" id="telefono"
                                            name="telefono" placeholder="Ingrese su número de teléfono" required
                                            maxlength="12" pattern="\d{1,12}" value="{{ old('telefono') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="postal" class="fw-bold">Codigo Postal:</label>
                                        <input class="mt-3 form-control custom-focus" type="text" id="postal"
                                            name="postal" placeholder="Ingrese su codigo postal" required
                                            value="{{ old('postal') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="estado" class="fw-bold">Estado:</label>
                                        <input class="mt-3 form-control custom-focus" type="text" id="estado"
                                            name="estado" placeholder="Ingrese su estado" required value="Yucatán">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ciudad" class="fw-bold">Ciudad:</label>
                                        <input class="mt-3 form-control custom-focus" type="text" id="ciudad"
                                            name="ciudad" placeholder="Ingrese su ciudad" required
                                            value="{{ old('ciudad') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion" class="fw-bold">Dirección:</label>
                                        <textarea class="mt-3 form-control custom-focus" id="direccion" name="direccion"
                                            placeholder="Ingrese su dirección completa" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="fw-bold">Foto de perfil:</label>
                                        <input type="file" id="foto" name="foto"
                                            class="mt-3 form-control custom-focus" accept="image/*">
                                    </div>
                                    <div class="text-center mt-5">
                                        <button class="btn btn-dark" type="submit">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
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
