@extends('site.layouts.master')
@push('styles')
    <style>
        .header-img {
            background-image: url('{{ asset('storage/sucursales/' . $json['branch']->image) }}');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Ajusta el valor alpha para la opacidad */
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 1;
            /* Para que el contenido esté encima de la capa de opacidad */
        }

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

        /* Estilos de la publicación */
        .post {
            display: flex;
            justify-content: space-between;
            margin: 20px;
        }

        .post-image {
            width: 30%;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .post-image:hover {
            transform: scale(1.1);
        }

        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            display: block;
            margin: 0 auto;
            max-width: 80%;
            max-height: 80%;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div id="vue">
        <div class="container-fluid">
            <header class="header-img align-items-center d-flex">
                <div class="overlay"></div>
                <div class="content row">
                    <div class="col-md-12 text-center">
                        <h1 class="fs-max text-white fw-bold">{{ $json['branch']->name_branch }}</h1>
                        <p class="text-white fw-light">
                            {{ $json['branch']->description }}
                        </p>
                    </div>
                </div>
            </header>
            <section class="shadow">
                <div class="row">
                    <div class="col text-center">
                        <div class="d-flex justify-content-center">
                            <div class="mt-5">
                                {!! Form::button('Publicaciones', [
                                    'class' => 'bg-white mb-5 btn custom-button',
                                    'style' => 'margin-left: 10px',
                                ]) !!}
                                {!! Form::button('Opiniones', ['class' => 'bg-white mb-5 btn custom-button', 'style' => 'margin-left: 10px']) !!}
                                {!! Form::button('Productos', ['class' => 'bg-white mb-5 btn custom-button', 'style' => 'margin-left: 10px']) !!}
                                {!! Form::button('Información', ['class' => 'bg-white mb-5 btn custom-button', 'style' => 'margin-left: 10px']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center ">
                    <div class="col-md-6">
                        <div class="modal mt-5 text-center animate__animated animate__fadeInDown" id="imageModal">
                            <div class="mt-5"></div>
                            <span class="close" onclick="closeImageModal()">&times;</span>
                            <img class="img-fluid mt-5" id="modalImage">
                        </div>
                        {{-- d-flex justify-content-center   --}}
                        @foreach ($json['post'] as $id => $value)
                            <div class="mt-4 shadow p-5">
                                <div class="text-center">
                                    <h2 class="fw-bold">{{ $value->Tittle }}</h2>
                                </div>
                                <div class="mt-5">
                                    <p class="fw-light">{{ $value->contenido }}</p>
                                </div>
                                <div class="mt-5 p-2 text-center">
                                    @php
                                        $images = [$value->img_1, $value->img_2, $value->img_3];
                                    @endphp
                                    @foreach ($images as $img)
                                        @if ($img)
                                            <img src="{{ asset('storage/postSucursales/' . $img) }}" class="post-image m-2 shadow"
                                                onclick="showImage('{{ asset('storage/postSucursales/' . $img) }}')">
                                        @endif
                                    @endforeach
                                </div>
                                <div class="mt-5">
                                         <div class="d-flex justify-content-between gap-2">
                                            <button style="border: none; background-color: white;"
                                            class="fw-light publicaciones"><i
                                                class="fas fa-comments" style="color:rgb(183, 193, 183);"></i>
                                            Comentarios</button>
                                            <button style="border: none; background-color: white;"
                                            class="fw-light publicaciones"><i
                                                class="fas fa-share" style="color:rgb(183, 193, 183);"></i>
                                            Compartir</button>
                                        </div>
                                </div>
                        @endforeach

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('child-scripts')
    <script>
        function showImage(imageSrc) {
            var modal = document.getElementById("imageModal");
            var modalImage = document.getElementById("modalImage");

            modal.style.display = "block";
            modalImage.src = imageSrc;
        }

        function closeImageModal() {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }
    </script>
    <script>
        var api = 'Api_comments';
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
