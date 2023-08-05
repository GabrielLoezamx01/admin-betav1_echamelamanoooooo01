@extends('site.layouts.master')
@section('content')
    <div id="vue" class="row">

        <div class="col-md-8">
            @if (session('type_user') == 'C')
                <section>
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="p-2 mt-5 m-4">
                                <p class="card-title fs-4 text-title fw-ligh">Nueva Publicacion</p>
                                <div class="mb-3">
                                    <textarea class="form-control custom-focus" rows="5" v-model="newPost"></textarea>
                                </div>
                                <p class="card-title fs-4 text-title fw-ligh">Servicio</p>
                                <div class="mb-3">
                                    <select v-model="servicies" class="form-control custom-focus " id="servicies">
                                        <option class="select-option" v-for="select in apiServicios" :value="select.id">
                                            @{{ select.name }}</option>
                                    </select>
                                </div>
                                <button class="btn btn-dark border-0 p-2 " @click="postnew()">Publicar</button>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <section>
                <div class="mt-5">
                    <h4 class="text-center m-5">Publicaciones recientes</h4>
                </div>
                <div class="row col-md-5 p-3">
                    <label for="">Buscar por servicio</label>
                    <div class="input-group mb-3">
                        <select v-model="serviciessearch" class="form-control custom-focus " id="servicies">
                            <option class="select-option" v-for="select in apiServicios" :value="select.id">
                                @{{ select.name }}</option>
                        </select>
                        <button class="btn btn-dark" type="button" id="btn-buscar"
                            @click="searchpublicaciones()">Buscar</button>
                    </div>

                </div>
                <div v-for="post in apiResponse">
                    <section class="card shadow">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-md-2 text-center">

                                    <img :src="'storage/fotos/' + post.photo" alt="Foto de perfil" class="profile-img mt-3">
                                    <div class="mt-2">
                                        <b>
                                            @{{ post.name }} @{{ post.last_name }}
                                        </b>
                                        <label for="">
                                            <small>@{{ post.date }}</small>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-10 p-2">
                                    <div class="chat-bubble">
                                        <div class="tail"></div>
                                        <p class="message">@{{ post.content }}</p>
                                    </div>
                                    <div class="post-actions d-flex justify-content-end flex-wrap p-5">
                                        <div v-if="post.uuidCliente == '{{ session('uuid') }}'">
                                            <button class="btn btn-danger" @click="deletePost(post.uuid)"><i
                                                    class="fas fa-trash"></i></button>
                                            <button class="btn btn-primary" @click="show_item(post.uuid)"><i
                                                    class="fas fa-edit"></i></button>
                                        </div>
                                        <button class="btn btn-secondary" @click="openDivComment(post.publications_id)"><i
                                                class="fas fa-comments"></i></button>
                                    </div>
                                    <div class="card-footer">
                                        <p>Servicio: @{{ post.nombre_servicio }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Editar Publicacion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <textarea class="form-control custom-focus" rows="5" v-model="name"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" @click="update_item()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4">
            @include('site.usertop')
        </div>
    </div>
@endsection
@push('child-scripts')
    <script>
        var api = 'Api_publications';
        var serivicios_api = 'api_servicios';
        var api_sucursales = 'api_sucursales';
        // var api_notificaciones  = 'api_notificaciones';
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
                    settingsNotify: []

                },
                created: function() {
                    this.getSHOW();
                    this.api_servicios();
                    this.api_servicios_sidebar();
                },
                mounted() {
                    // setInterval(this.getSHOW, 5000);
                    // setInterval(() => {
                    //     this.coment(this.idpublicacion);
                    // }, 1000);
                },
                methods: {
                    getSHOW: function() {
                        this.$http.get(api).then(function(response) {
                            this.apiResponse = response.body.data
                        });
                    },
                    api_servicios: function() {
                        this.$http.get(serivicios_api).then(function(data) {
                            this.apiServicios = data.body;
                        });
                    },
                    api_servicios_sidebar: function() {
                        this.$http.get(serivicios_api + '?sidebar=true').then(function(data) {
                            this.apiServiciossidebar = data.body;
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
                    searchpublicaciones: function() {
                        this.apiResponse = [];
                        var id = this.serviciessearch;
                        const url = '?search=true&id=' + id;
                        console.log(api + url);
                        this.$http.get(api + url).then(function(response) {
                            console.log(response.body);
                            this.apiResponse = response.body.data
                        });
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
                                        this.bootrappModal('close');
                                    }
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
                    // updateNotify: function(id) {
                    //     var data = {};
                    //     this.$http.patch(api_notificaciones + '/' + id, data)
                    //         .then(function(json) {});
                    // }
                },
                computed: {}
            })
        }
    </script>
@endpush
