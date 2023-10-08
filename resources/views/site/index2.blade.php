@extends('site.layouts.master')
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
                @if (session('type_user') == 'C')
                    <div class="border-0 ">
                        <div class="card-body p-3 shadow bg-white rounded-3">
                            <div class="p-2 mt-5 m-4 ">
                                <p class="card-title fs-5 text-title fw-light"><i class="fas fa-edit"></i> Nueva Publicacion
                                </p>
                                <div class="mb-3 mt-3 textarea-container">
                                    <textarea class="custom-textarea fw-light text-sys" rows="5" v-model="newPost" maxlength="400"
                                        placeholder="Escribe tu post aquí"></textarea>
                                </div>
                                <p class="card-title fs-5 text-title fw-light mt-5"> <i class="fas fa-cogs"></i> Servicio
                                </p>
                                <div class="input-container">
                                    <select v-model="servicies" class="custom-select custom-textarea" id="servicies">
                                        <option class="select-option" v-for="select in apiServicios" :value="select.id">
                                            @{{ select.name }}</option>
                                    </select>
                                </div>

                                <div class="button-container">
                                    <button class="publish-button" @click="postnew()">
                                        <i class="icon fas fa-paper-plane"></i>
                                        Publicar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="mt-5"></div>
                <div class="text-center">
                    <h2>
                        Últimas publicaciones de la comunidad Echamelamano.
                    </h2>
                </div>
                <div class="modal mt-5 text-center animate__animated animate__fadeInDown" id="imageModal">
                    <div class="mt-5"></div>
                    <span class="close" onclick="closeImageModal()">&times;</span>
                    <img class="img-fluid mt-5" id="modalImage">
                </div>
                @foreach ($post as $key => $data)
                <div class="row d-flex justify-content-center mt-5 shadow">
                    <div class="col-md-3 mt-5 text-center">
                        <img src="{{ asset('storage/sucursales/' . $data->image) }}" alt="Imagen"
                            class="circular-image img-fluid">
                        <h5 class="fw-bold mt-3">{{ $data->name_branch }}</h5>
                        <label for="" class="fw-light" style="font-size: 12px">
                            {{$data->description}}
                        </label>
                        <div class="mt-5">
                            <label for="" class="fw-light" style="font-size: 12px">
                                {{$data->city}},  {{$data->address}}, {{$data->postal_code}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-7 mt-5 overflow-hidden"> <!-- Agregamos la clase overflow-hidden aquí -->
                        <div class="mt-4 p-5">
                            <div class="text-center">
                                <h2 class="fw-bold">  {{$data->Tittle}}</h2>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="fw-light">{{ $data->contenido }}</p>
                        </div>
                        <div class="mt-5 p-2 d-flex justify-content-center">
                            @php
                            $images = [$data->img_1, $data->img_2, $data->img_3];
                            @endphp
                            @foreach ($images as $img)
                                @if ($img)
                                    <img src="{{ asset('storage/postSucursales/' . $img) }}"
                                        class="post-image m-2 shadow img-fluid img-thumbnail"
                                        style="max-width: 200px;"
                                        onclick="showImage('{{ asset('storage/postSucursales/' . $img) }}')">
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-5">
                            <div class="d-flex justify-content-between gap-2">
                                <button style="border: none; background-color: white;"
                                    class="fw-light publicaciones"><i class="fas fa-comments"
                                        style="color:rgb(183, 193, 183);"></i>
                                    Comentarios</button>
                                <button style="border: none; background-color: white;"
                                    class="fw-light publicaciones"><i class="fas fa-share"
                                        style="color:rgb(183, 193, 183);"></i>
                                    Compartir</button>
                            </div>
                        </div>
                        <div class="p-5"></div>
                    </div>
                </div>
            @endforeach

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
        var api = 'Api_publications'
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
                    apiResponse: [],
                    sucursales: [],
                    pagination: 0,
                    comments: [],
                    idpublicacion: 0,
                    conectadi: 'VUE JS',
                    name: '',
                    save: true,
                    edit: false,
                    uuid: '',
                    pcomentario: '',
                    newPost: '',
                    divcomment: false,
                    apiServicios: [],
                    apiServiciossidebar: [],
                    servicies: 0,
                    serviciessearch: 0,
                    modalVisible: false,
                    someModal: "",
                    arrayNotify: [],
                    countNotify: 0,
                    settingsNotify: [],

                },
                created: function() {
                    this.api_servicios();
                    this.sucursales_api();
                },
                mounted() {
                    // setInterval(this.getSHOW, 5000);
                    // setInterval(() => {
                    //     this.coment(this.idpublicacion);
                    // }, 1000);
                },
                methods: {
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
                    postnew: function() {
                        if (this.newPost == "" || this.servicies == 0) {
                            alert('No puede estar vacio la publicacion');
                        } else {
                            var data = {
                                'content': this.newPost,
                                'servicie': this.servicies,
                                'uuid': this.generate_uuid()
                            };
                            this.$http.post(api, data)
                                .then(function(json) {
                                    console.log(json);
                                    this.newPost = '';
                                    this.servicies = 0;
                                    this.getSHOW();
                                });
                        }
                    },

                    generate_uuid: function() {
                        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                            var r = Math.random() * 16 | 0,
                                v = c == 'x' ? r : (r & 0x3 | 0x8);
                            return v.toString(16);
                        });
                    },
                    modal: function(value) {
                        var myModal = new bootstrap.Modal(document.getElementById('modal'), {
                            backdrop: 'static'
                        });
                        if (value) {
                            myModal.show();
                        }
                        myModal.hide();
                    },
                    save_item: function() {
                        if (!this.name == '') {
                            var data = {
                                'cat_name': this.name,
                                'cat_status': 'A',
                                'cat_uuid': this.generate_uuid()
                            };
                            this.$http.post(api, data)
                                .then(function(json) {
                                    this.name = '';
                                    this.getSHOW();
                                    this.success_alert();
                                });

                        }
                    },
                    show_item: function(uuid) {
                        this.$http.get(api + '/' + uuid)
                            .then(function(json) {
                                this.name = json.data.content;
                                this.uuid = json.data.uuid;
                                this.servicies = json.data.id_servicio;
                                this.bootrappModal('open');
                            });
                    },
                    update_item: function() {
                        if (!this.uuid == '' && !this.name == '') {
                            var data = {
                                cat_name: this.name,
                            };
                            this.$http.patch(api + '/' + this.uuid, data)
                                .then(function(json) {
                                    if (json.status == 200) {
                                        this.uuid = '';
                                        this.name = '';
                                        this.success_alert();
                                    }
                                    this.bootrappModal('close');
                                    this.getSHOW();
                                });
                        }
                    },
                    deletePost: function(id) {
                        this.msg_confirmation(id);
                    },
                    msg_confirmation: function(id) {
                        Swal.fire({
                                title: '¿Estás seguro?',
                                text: 'Una vez eliminado, no podrás recuperar este elemento.',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Eliminar',
                                cancelButtonText: 'Cancelar',
                                dangerMode: true
                            })
                            .then((willDelete) => {
                                if (willDelete.isConfirmed) {
                                    this.$http.delete(api + '/' + id)
                                        .then(function(json) {
                                            this.getSHOW();
                                            Swal.fire('¡Eliminado!', 'El elemento ha sido eliminado.',
                                                'success');
                                        })
                                } else {
                                    Swal.fire('Cancelado', 'La eliminación ha sido cancelada.', 'info');
                                }
                            });
                    },
                    bootrappModal: function(setting) {
                        this.someModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                        switch (setting) {
                            case 'close':
                                this.someModal.hide();
                                break;
                            case 'open':
                                this.someModal.show();
                                break;
                            default:
                                modal.show();
                        }
                    },
                    success_alert: function() {
                        Swal.fire({
                            title: '¡Excelente!',
                            text: 'Se ha actualizado correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                    },
                    close_modal: function() {
                        $('#modal').modal('hide');
                        this.name = '';
                    },
                    modal: function(id) {
                        UIkit.modal('#mi-modal').show();
                        this.coment(id);
                    },
                    openDivComment: function(id) {
                        const dominio = "http://localhost/admin/public/";
                        const nuevaRuta = "comments?id=" + id;
                        window.location.assign(nuevaRuta);
                    },
                    getJsonValue(jsonString, key) {
                        this.settingsNotify = JSON.parse(jsonString);
                    },

                },
                computed: {}
            })
        }
    </script>
@endpush
