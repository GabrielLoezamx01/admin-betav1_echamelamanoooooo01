@extends('site.layouts.master')
@section('content')
    <div id="vue">
        <div class="row">
            <div class="offset-1 col-md-8">
                <h4 class="text-center">Publicaciones recientes <button class="btn text-end" title="Refrescar contenido"
                        @click="getSHOW()">
                        <i class="fas fa-sync text-dark"></i>
                    </button></h4>
                <div class="col-md-6 mt-3">
                    <label for="">Buscar por servicio</label>
                    <div class="input-container">
                        <div class="input-group mb-3">
                            <select v-model="serviciessearch" class="form-control custom-select custom-textarea "
                                id="servicies">
                                <option class="select-option" v-for="select in apiServicios" :value="select.id">
                                    @{{ select.name }}</option>
                            </select>
                            <button class="publish-button" type="button" id="btn-buscar" title="Buscar"
                                @click="searchpublicaciones()"><i class="fas fa-search search-icon"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <section class="row ">
            <div class="col-md-4"></div>
            <div class=" col-md-5">
                <div class="row">
                    <div v-for="post in apiResponse" class="col-md-10">
                        <div class="card mt-5 border-0 shadow" data-aos="fade-up" data-aos-duration="1000">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img :src="'storage/fotos/' + post.photo" alt="Foto de perfil"
                                        class="img-fluid shadow circular-image">
                                    <div class="col p-3">
                                        <label for="user" class="fw-bold mt-3 tex" style="font-size: 2vh">
                                            @{{ post.userName }}
                                        </label>
                                        <div class="mt-2 text-justify">
                                            <p class="fw-light text-dark-50">
                                                @{{ post.content }}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer bg-white">
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <p style="font-size: 12px;" class="fw-light">
                                            Servicio: @{{ post.nombre_servicio }} </p>
                                        <p style="font-size: 14px;" class="fw-light" v-if="likes[post.uuid]">
                                            @{{ likes[post.uuid].total }} Me gusta</p>
                                        <p style="font-size: 14px;" class="fw-light" v-else> 0 Me gusta</p>

                                    </div>
                                </div>

                                <div class="justify-content-end mt-5">

                                    {{-- <div v-if="likes[post.uuid].id_seller.includes(skmksm)">
                                        El valor existe en id_seller.
                                      </div>
                                      <div v-else>
                                        El valor no existe en id_seller.
                                      </div> --}}
                                    {{-- @{{ likes }} --}}
                                    <div class="d-flex justify-content-between gap-2">
                                        {{-- <div v-if="post.uuidCliente == '{{ session('uuid') }}'">
                                            <button class="btn  btn-sm " style="background-color: #342E37; color: white;"
                                                @click="show_item(post.uuid)"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm" style="background-color: #C42021; color: white;"
                                                @click="deletePost(post.uuid)"><i class="fas fa-trash"></i></button>
                                        </div> --}}
                                        <div
                                            v-if="likes[post.uuid] && likes[post.uuid].id_seller && likes[post.uuid].id_seller.includes('{{ session('uuid') }}')">
                                            <button style="border: none; background-color: white;"
                                                class="fw-light publicaciones" @click="likespost(post.uuid , '{{ session('uuid') }}'), true">
                                                <i class="fas fa fa-heart text-danger"></i>
                                                Me gusta</button>
                                        </div>
                                        <div v-else>
                                            <div :class="{ 'd-none': likes[post.uuid] && likes[post.uuid].id_seller && likes[post.uuid].id_seller.includes('{{ session('uuid') }}') }">
                                                <button style="border: none; background-color: white;" class="fw-light publicaciones" @click="likespost(post.uuid , '{{ session('uuid') }}')">
                                                    Me gusta
                                                </button>
                                            </div>

                                        </div>

                                        <button style="border: none; background-color: white;"
                                            class="fw-light publicaciones" @click="openDivComment(post.publications_id)"><i
                                                class="fas fa-comments" style="color:rgb(183, 193, 183);"></i>
                                            Comentar</button>
                                        <button style="border: none; background-color: white;"
                                            class="fw-light publicaciones" @click="compartir(post.uuid)"><i
                                                class="fas fa fa-share" style="color:rgb(183, 193, 183);"></i>
                                            Compartir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        var api = 'Api_publications';
        var serivicios_api = 'api_servicios';
        var api_sucursales = 'api_sucursales';
        var api_likes = 'likes_api?id_post=';
        var api_likes_post = 'likes_api';

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
                    likes: {},
                    ids_post: '',
                    ocultar: true,
                    love: false
                },
                created: function() {
                    this.getSHOW();
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
                    likesApi: function(uuid) {
                        this.$http.get(api_likes + this.ids_post).then(function(response) {
                            this.likes = response.body;
                        });
                    },
                    likespost: function (id_post , id_user, validacion){
                        var data = {
                                'id_user': id_user,
                                'id_post': id_post,
                        };
                        if(validacion){
                            this.love = false;
                        }
                        this.$http.post(api_likes_post, data).then(function(json) {
                            this.getSHOW();
                        });
                    },
                    getSHOW: function() {
                        this.$http.get(api).then(function(response) {
                            this.apiResponse = response.body.data;
                            const ids = this.apiResponse.map(function(objeto) {
                                return objeto.uuid;
                            });
                            this.ids_post = ids.join(',');
                            this.likesApi();
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
