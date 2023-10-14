@extends('site.layouts.master')
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
        </style>
    @endpush
    <div id="vue">
        <section class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                <div class="border-0 card card-body p-3 shadow bg-white rounded-3">
                    <div class="p-2 mt-5 m-4">
                        <p class="card-title fs-5 text-title fw-light">
                            <i class="fas fa-edit"></i> Nueva Publicación
                        </p>
                        <div class="mb-3 mt-3 textarea-container">
                            <textarea class="custom-textarea fw-light text-sys" rows="5" v-model="newPost" maxlength="400"
                                placeholder="Escribe tu post aquí"></textarea>
                        </div>
                        <p class="card-title fs-5 text-title fw-light mt-5">
                            <i class="fas fa-cogs"></i> Servicio
                        </p>
                        <div class="input-container">
                            <select v-model="servicies" class="custom-select custom-textarea" id="servicies">
                                <option class="select-option" v-for="select in apiServicios" :value="select.id">
                                    @{{ select.name }}
                                </option>
                            </select>
                        </div>
                        <div class="button-container">
                            <button class="publish-button" @click="postnew()">
                                <i class="icon fas fa-paper-plane"></i> Publicar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h2>Últimas publicaciones de la comunidad Echamelamano.</h2>
                    @{{ posts }}
                </div>
                <div class="modal mt-5 text-center animate__animated animate__fadeInDown" id="imageModal">
                    <div class="mt-5"></div>
                    <span class="close" onclick="closeImageModal()">&times;</span>
                    <img class="img-fluid mt-5" id="modalImage">
                </div>
            </div>
            <div class="col-md-3">
                @include('site.usertop')
            </div>
        </section>
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
        var api            = 'Api_publications'
        const api_post     = 'api_branch_post';
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
