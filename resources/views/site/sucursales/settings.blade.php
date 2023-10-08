@extends('site.layouts.master')
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
    <div id="vue">
        <div class="row">
            <div class="col-md-12 text-center">
                <button class="custom-button btn">Publicaciones</button>
                <button class="custom-button btn">Mi informacion</button>
            </div>
            <div class="col-md-8 mx-auto text-center mt-5">
                @php
                $id_branch = request('id_branch');
                @endphp
                <form action="ajustes_sucursal" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_branch" value="{{ $id_branch }}">
                    <h2 class="fs-4">Nuevo Publicacion</h2>
                    <input type="text" placeholder="Titulo de la publicacion" class="custom-textarea" name="Tittle">
                    <textarea class="custom-textarea fw-light text-sys mt-3" rows="5" name="contenido" maxlength="400"
                        placeholder="Escribe tu post aquí"></textarea>
                    <div>
                        <label for="image1" class="custom-file-label btn    ">
                            Subir Imagen 1
                        </label>
                        <input type="file" name="image1" id="image1" accept="image/*" onchange="previewImage(this, 'preview1')" class="custom-file-input">
                        <img id="preview1" src="#" alt="" style="max-width: 100px; max-height: 100px;" class="img-fluid">
                        <label for="image2" class="custom-file-label btn">
                            Subir Imagen 2
                        </label>
                        <input type="file" name="image2" id="image2" accept="image/*" onchange="previewImage(this, 'preview2')" class="custom-file-input">
                        <img id="preview2" src="#" alt="" style="max-width: 100px; max-height: 100px;">
                        <label for="image3" class="custom-file-label btn">
                            Subir Imagen 3
                        </label>
                        <input type="file" name="image3" id="image3" accept="image/*" onchange="previewImage(this, 'preview3')" class="custom-file-input">
                        <img id="preview3" src="#" alt="" style="max-width: 100px; max-height: 100px;">
                    </div>
                    <button class="publish-button">
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
