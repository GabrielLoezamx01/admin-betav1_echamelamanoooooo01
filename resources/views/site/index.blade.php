@extends('site.layouts.master')
@section('content')
    <div id="vue" class="row">
        <div class="col-md-3">
            @include('site.sidebar')
        </div>
        <div class="col-md-7">
            <section>
                <div class="card border-0">
                    <div class="card-body shadow">
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
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="m-3">
                                    <img :src="'storage/fotos/' + post.photo" alt="Foto de perfil" class="profile-img">
                                </div>
                                <div>
                                    <a href="users/post.id_user">
                                        <h5 class="card-title mb-0"> @{{ post.name }} @{{ post.last_name }}
                                    </a>
                                    <span v-if="post.VALIDACION == 1" class="verification-icon verified"><i
                                            class="fas fa-check"></i></span>
                                    <span v-if="post.VALIDACION == 0" class="verification-icon not-verified"><i
                                            class="fas fa-times"></i></span>
                                    </h5>
                                    <div class="post-date">
                                        <small>@{{ post.date }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="post-content p-2">
                                <p class="fw-light">@{{ post.content }} </p>
                            </div>
                            <div class="post-actions d-flex justify-content-end flex-wrap">
                                <div v-if="post.uuidCliente == '{{ session('uuid') }}'">
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                </div>
                                <button class="btn btn-secondary"><i class="fas fa-comments"></i></button>
                            </div>
                            <div class="card-footer">
                                <p>Servicio: @{{ post.nombre_servicio }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-2">
        </div>
    </div>
@endsection
@push('child-scripts')
    <script>
        var api = 'Api_publications';
        var serivicios_api = 'api_servicios';
        var api_comentarios = 'Api_comments'; {
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
                    serviciessearch: 0
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
                        this.$http.get(serivicios_api + '?sidebar=true' ).then(function(data) {
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
                        var id = this.serviciessearch;
                        const url = '?search=true&id=' + id;
                        this.$http.get(api + url).then(function(response) {
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
                        this.save = false;
                        this.edit = true;
                        this.modal(true);
                        this.$http.get(api + '/' + uuid)
                            .then(function(json) {
                                this.name = json.data.cat_name;
                                this.uuid = json.data.cat_uuid
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
                                        this.getSHOW();
                                        this.close_modal();
                                        this.success_alert();
                                    }
                                });
                        }
                    },
                    delete_item: function(id) {
                        this.msg_confirmation(id);
                    },
                    msg_confirmation: function(id) {
                        swal({
                                title: "Estas seguro?",
                                text: "¡Una vez eliminado, no podrá recuperar este archivo imaginario!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    this.$http.delete(api + '/' + id)
                                        .then(function(json) {
                                            this.getSHOW();
                                            swal("¡Eliminado!", {
                                                icon: "success",
                                            });
                                        })
                                } else {
                                    swal("ok");
                                }
                            });
                    },
                    success_alert: function() {
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
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
                    coment: function(id) {
                        this.idpublicacion = id;
                        this.$http.get(api_comentarios + '/' + id)
                            .then(function(json) {
                                this.comments = json.body;
                                console.log(this.comments);
                            });
                    },
                    comentar: function() {
                        if (!this.pcomentario == '') {
                            var data = {
                                'comentario': this.pcomentario,
                                'publications_id': this.idpublicacion,
                            };
                            this.$http.post(api_comentarios, data)
                                .then(function(json) {
                                    this.pcomentario = '';
                                    this.coment(this.idpublicacion);
                                    // this.success_alert();
                                });

                        } else {
                            alert('Este campo no puede estar vacio');
                        }
                        // Aquí se puede agregar la lógica para enviar el comentario
                    }
                },
                computed: {}
            })
        }
    </script>
@endpush
