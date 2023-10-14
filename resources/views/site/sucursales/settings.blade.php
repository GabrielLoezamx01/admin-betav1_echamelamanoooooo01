@extends('site.layouts.master')
@section('title', 'Ajustes de la sucursal')
@push('styles')
    <style>
        .fs-max {
            font-size: 5rem;
        }

        .btn-site {
            width: 20%;
        }

        .custom-button {
            display: inline-block;
            font-size: 1rem;
            width: 400px;
            padding: 20px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            position: relative;
            transition: all 0.3s ease-in-out;
        }

        .custom-button::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #000;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease-in-out;
        }

        .custom-button:hover::before {
            transform: scaleX(1);
        }
        .custom-file-input {
            display: none;
        }

        .custom-file-label::after {
            content: "\f093"; /* Icono de carga de Font Awesome (puedes cambiarlo según tu preferencia) */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 1.2em;
        }
    </style>
@endpush
@section('content')
<div id="vue" class="container">
    <div class="row mt-5">
        <div class="col-md-6 mx-auto text-center p-5">
            <form action="{{ route('insert_colors_branch') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_branch" value="{{ $settings['id_branch'] }}">
                <div class="form-group mt-5">
                    <label for="colorPicker">Selecciona tu color principal:</label>
                    <input type="color" class="form-control custom-textarea" id="colorPicker" name="color_1" value="{{ $settings['primary_color'] }}">
                </div>
                <div class="form-group mt-5">
                    <label for="colorPicker">Selecciona tu color de texto:</label>
                    <input type="color" class="form-control custom-textarea" id="colorPicker" name="color_2" value="{{ $settings['color_1'] }}">
                </div>
                <div class="form-group mt-5">
                    <label for="colorPicker">Selecciona tu tercer color (opcional)</label>
                    <input type="color" class="form-control custom-textarea" id="colorPicker" name="color_3" value="{{ $settings['color_2'] }}">
                </div>
                <div class="form-group mt-5">
                    <label for="colorPicker">Selecciona tu foto de portada</label>
                    <input type="file" class="form-control custom-textarea" id="colorPicker" name="portada">
                </div>
                <div class="form-group mt-5 text-center">
                    <button class="btn btn-primary publish-button mt-3">
                        ACEPTAR
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-6 mx-auto text-center p-5">

            <form action="ajustes_sucursal" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_branch" value="{{ $settings['id_branch'] }}">
                <h2 class="fs-4">Nueva Publicación</h2>
                <input type="text" class="form-control custom-textarea" placeholder="Título de la publicación" name="Tittle">
                <textarea class="form-control custom-textarea fw-light text-sys mt-3" rows="5" name="contenido" maxlength="400"
                    placeholder="Escribe tu post aquí"></textarea>
                <div class="mt-5">
                    <label for="image1" class="btn custom-file-label">
                        Subir Imagen 1
                    </label>
                    <input type="file" name="image1" id="image1" accept="image/*" onchange="previewImage(this, 'preview1')" class="custom-file-input">
                    <img id="preview1" src="#" alt="" style="max-width: 100px; max-height: 100px;" class="img-fluid">
                    <label for="image2" class="btn custom-file-label">
                        Subir Imagen 2
                    </label>
                    <input type="file" name="image2" id="image2" accept="image/*" onchange="previewImage(this, 'preview2')" class="custom-file-input">
                    <img id="preview2" src="#" alt="" style="max-width: 100px; max-height: 100px;">
                    <label for="image3" class="btn custom-file-label">
                        Subir Imagen 3
                    </label>
                    <input type="file" name="image3" id="image3" accept="image/*" onchange="previewImage(this, 'preview3')" class="custom-file-input">
                    <img id="preview3" src="#" alt="" style="max-width: 100px; max-height: 100px;">
                </div>
                <button class="btn btn-primary publish-button mt-3">
                    <i class="icon fas fa-paper-plane"></i>
                    Publicar
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
@push('child-scripts')
<script>
    function previewImage(input, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById(imgId).src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
    <script>
        new Vue({
            el: '#vue',
            http: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            },
            data: {
            },
            created: function() {},
            methods: {

            }
        });
    </script>
@endpush
