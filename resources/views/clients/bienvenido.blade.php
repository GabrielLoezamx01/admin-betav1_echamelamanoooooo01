@extends('layouts.master')
@section('title', 'Bienvenido')
@section('content')
    @push('styles')
        <style>
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

            .custom-img {
                width: 150px;
                /* El tamaño deseado */
                height: 150px;
                /* El tamaño deseado */
                object-fit: cover;
                /* Esto mantendrá la imagen completamente visible */
            }

            .custom-img-c {
                width: 150px;
                height: 400px;
                object-fit: cover;
            }
            .gradiant-post{
                border-radius: 29px;
                background: linear-gradient(180deg, rgba(36, 159, 17, 0.15) 0%, rgba(0, 0, 0, 0.00) 100%);

                box-shadow: 0px 12px 11px 0px rgba(0, 0, 0, 0.11);
            }
        </style>
    @endpush

    <section class="row">
        <div class="col p-5 text-center">
            <h1 class="fs-1">Publicaciones de la comunidad <span class="fw-bold">Echamelamano</span>.</h1>
        </div>
    </section>

    <div class="row" id="vue">
        <div class="offset-md-1 col-md-6">
            <div v-for="post in posts" class="mt-5 gradiant-post">
                <div class="row align-items-center m-5">
                    <div class="col-md-3 col-sm-6 text-center mt-5">
                        <img :src="'storage/sucursales/' + post.image" alt="Imagen de la sucursal"
                            class="rounded-circle img-fluid custom-img shadow">
                    </div>
                    <div class="col-md-6 col-sm-6 mt-5">
                        <a :href="'sucursal?id_branch=' + post.id_branch">
                            <h2 class="fs-2 fw-bold text-center text-sm-start ">@{{ post.name_branch }}</h2>
                        </a>
                        {{-- <address class="fw-light">@{{ post.address }} , @{{ post.city }} @{{ post.postal_code }}
                        </address> --}}
                    </div>
                    <div class="col-md-3 col-12 mt-3 text-end">
                        <button class="btn elegant-button">Seguir</button>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-3 col-md-8">
                        <article>
                            <h3 class="fw-bold">@{{ post.Tittle }}</h3>
                            <p class="mt-3">@{{ post.contenido }}</p>
                        </article>
                        <div id="carouselExample" class="carousel slide carousel-fade carousel-control-bottom shadow" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div v-for="(image, index) in [post.img_1, post.img_2, post.img_3]" :key="index">
                                    <!-- Filtra imágenes vacías -->
                                    <div v-if="image" :class="['carousel-item', index === 0 ? 'active' : '']">
                                        <!-- Aplica un estilo para que todas las imágenes tengan el mismo tamaño -->
                                        <img :src="'storage/postSucursales/' + image"
                                            class="d-block w-100 img-fluid custom-img-c" :alt="'Imagen ' + (index + 1)">
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                              </a>
                        </div>
                        <div class="row p-5">
                            <div class="col">
                                <button style="border: none; background-color: white;" class="fw-light publicaciones"
                                    @click="likespost(post.uuid, '{{ session('uuid') }}', true)">
                                    <i class="fas fa fa-heart"></i>
                                    Me gusta
                                </button>
                            </div>
                            <div class="col text-end">
                                <button style="border: none; background-color: white;" class="fw-light publicaciones"
                                    @click="sharedPost(post.id_post)">
                                    <i class="fas fa fa-share"></i>
                                    Compartir
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('site.usertop')
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
        var serivicios_api = 'api_servicios';
        var api_sucursales = 'api_sucursales';
        var api = 'Api_publications'
        const api_post = 'api_branch_post';
        {
            new Vue({
                el: '#vue',
                http: {
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                },
                data: {
                    counter: 0,
                    sucursales: [],
                    apiServicios: [],
                    posts: [],
                },
                created: function() {
                    this.api_servicios();
                    this.sucursales_api();
                    this.getPost();
                },
                mounted() {
                    // setInterval(this.getSHOW, 5000);
                    // setInterval(() => {
                    //     this.coment(this.idpublicacion);
                    // }, 1000);
                },
                methods: {
                    sharedPost: function(idpost) {
                        var data = {
                            'id_post': idpost,
                        };
                        this.$http.post('api_share', data)
                            .then(function(json) {
                                alert(json.body);
                            });
                    },
                    api_servicios: function() {
                        this.$http.get(serivicios_api).then(function(data) {
                            this.apiServicios = data.body;
                        });
                    },
                    sucursales_api: function() {
                        this.$http.get(api_sucursales).then(function(data) {
                            this.sucursales = data.body;
                        });
                    },
                    getPost: function() {
                        this.$http.get(api_post).then(function(data) {
                            this.posts = data.body;
                        });
                    }
                },
                computed: {}
            })
        }
    </script>
@endpush
