@extends('site.layouts.master')
@push('styles')

    <style>
        .elegant-button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #fff;
            background-color: #249f11;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .elegant-button:hover {
            background-color: #1a7d0a;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
        }

        .elegant-button.secondary {
            background-color: #2a2a2a;
        }

        .elegant-button.secondary:hover {
            background-color: #1e1e1e;
        }

        .elegant-button.outlined {
            background-color: transparent;
            border: 2px solid #249f11;
            color: #249f11;
        }

        .elegant-button.outlined:hover {
            background-color: #249f11;
            color: #fff;
        }

        .elegant-button.accent {
            background-color: #ff6f00;
        }

        .elegant-button.accent:hover {
            background-color: #d95c00;
        }

        .elegant-button.icon-button {
            padding: 10px;
            border-radius: 50%;
            background-color: #249f11;
            color: #fff;
            font-size: 24px;
        }

        .elegant-button.icon-button:hover {
            background-color: #1a7d0a;
        }

        .outlined-button {
            display: inline-block;
            /* padding: 12px 24px; */
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #249f11;
            background-color: transparent;
            border: 2px solid #249f11;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
        }

        .outlined-button:hover {
            background-color: #249f11;
            color: #fff;
            transform: scale(1.05);
        }

        .outlined-button.stroked {
            background-color: transparent;
            border: 2px solid #2a2a2a;
            color: #2a2a2a;
        }

        .outlined-button.stroked:hover {
            background-color: #2a2a2a;
            color: #fff;
        }

        .outlined-button.underline {
            position: relative;
            overflow: hidden;
        }

        .outlined-button.underline::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #249f11;
            bottom: 0;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s;
        }

        .outlined-button.underline:hover::before {
            transform: scaleX(1);
        }

        .row-even {
            background-color: #FAFAFA;
        }

        .row-odd {
            background-color: #ffffff;
            /* Color blanco para filas impares */
        }
    </style>
@endpush
@section('content')
    <div class="container" id="vue">
        <div class="row shadow">
            <div class="p-5 left-side col-md-7">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('storage/fotos/' . $publicaciones['photo']) }}" alt="Foto"
                            class="rounded-circle me-3" width="100" height="100">
                    </div>
                    <div class="col-md-7">
                        <label for="username" class="fw-bold fs-6">{{ $publicaciones['userName'] }}</label>
                        <div class="mt-1">
                            <span style="font-size: 13px;">Servicio: {{ $publicaciones['nombre_servicio'] }}</span>
                        </div>
                        <div class="mt-1">
                            <span style="font-size: 13px;">Dirrecion: {{ $publicaciones['andress'] }}</span>
                        </div>
                        <p class="mt-5 fw-light">
                            {{ $publicaciones['content'] }}
                        </p>
                        <div class="mt-5">
                            @if (count($validate) > 0)
                                <div class="mt-5 text-center">
                                    <button class="publish-button">EchameLamano</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="col-md-5">
                <button class="btn outlined-button stroked">
                    Comentarios
                </button>
            </div> --}}
            <div class="col-md-5 shadow animate__animated animate__backInRight">
                <div class="mt-2 right-side">
                    <h4>Comentarios</h4>
                    <div class="container ">
                        <div class="row mt-2" v-for="(comentario, index) in comentarios" :key="index"
                            :class="{ 'row-even': index % 2 === 0, 'row-odd': index % 2 !== 0 }">
                            <div class="col-md-12 mx-auto">
                                <div class="scrollable-div">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img :src="'storage/fotos/' + comentario.photo" alt="Foto de perfil"
                                                            class="img-fluid circular-image"> --}}
                                                        {{-- <img src="{{ asset('storage/fotos/' . $item->photo) }}" alt="Foto"
                                                                class="rounded-circle me-3 shadow" width="40" height="40"> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <h6 class="fw-bold mt-2">@{{ comentario.userName }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        {{-- <small class="text-muted" style="font-size: 10px">@{{ comentario.date }}</small> --}}
                                        <div>
                                            <p class="fw-light" style="font-size: 14px">
                                                @{{ comentario.comentario }}</p>
                                            <div v-if="editar_comentario == true && row == comentario.comments_id"
                                                class="">
                                                <input type="text" v-model="comentario.comentario"
                                                    class="form-control custom-focus">
                                                <button class="btn mt-2 btn-sm btn-dark"
                                                    @click="editarc(comentario.comments_id,comentario.comentario )">Actualizar</button>
                                            </div>

                                        </div>
                                        <div v-if="comentario.id_user_comments == '{{ session('uuid') }}'">
                                            <div class="text-center">
                                                <button class="btn btn-sm btn-danger  animate__animated animate__fadeInUp"
                                                    v-if="open == true && row == comentario.comments_id"
                                                    @click="eliminar(comentario.comments_id)"> <i
                                                        class="fas fa-trash"></i></button>
                                                <button class="btn btn-sm btn-primary  animate__animated animate__fadeInUp"
                                                    @click="editar(comentario.comments_id)"
                                                    v-if="open == true && row == comentario.comments_id"> <i
                                                        class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm" title="ajustes"
                                                    @click="open_settings(comentario.comments_id)">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                            </div>

                                            {{-- <button class="btn btn-sm btn-outline-danger me-2">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </button> --}}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 p-5">
                    @csrf
                    <textarea class="custom-textarea fw-light text-sys" rows="3" v-model="contenido"></textarea>
                    <button class="publish-button mt-5" @click="comentar()">Agregar Comentario</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('child-scripts')
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
                id: 0,
                comentarios: [],
                open: false,
                row: 0,
                idp: 0,
                uuidc: '',
                contenido: '',
                comentario_edit: '',
                editar_comentario: false,
                coments: ''
            },
            created: function() {
                this.comentarios_api();
            },
            methods: {
                comentarios_api: function() {
                    const params = new URLSearchParams(window.location.search);
                    this.id = params.get('id');
                    this.$http.get(api + '/' + this.id).then(function(data) {
                        this.comentarios = data.body;
                    });
                },
                open_settings: function(row) {
                    if (this.open == true) {
                        this.open = false;
                        this.row = 0;
                    } else {
                        this.open = true;
                        this.row = row;
                    }
                },
                comentar: function() {
                    if (this.contenido == '') {
                        alert('Contenido vacio');
                    } else {
                        var data = {
                            'idp': '{{ $publicaciones['publications_id'] }}',
                            'uuidc': '{{ $publicaciones['id_user'] }}',
                            'contenido': this.contenido
                        };
                        this.$http.post(api, data)
                            .then(function(json) {
                                console.log(json.body);
                                this.idp = '';
                                this.uuidc = '';
                                this.contenido = '';
                                this.comentarios_api();
                            });
                    }
                },
                eliminar: function(id) {
                    const confirmed = window.confirm('¿Eliminar?');
                    if (confirmed) {
                        this.$http.delete(api + '/' + id)
                            .then(function(json) {
                                this.comentarios_api();
                            })
                    }

                },
                editar: function(id) {
                    this.editar_comentario = true;
                    this.row = id;
                },
                editarc: function(id, valor) {
                    var data = {
                        comentario: valor,
                    };
                    this.$http.patch(api + '/' + id, data)
                        .then(function(json) {});
                    this.comentarios_api();
                    this.editar_comentario = false;
                    this.row = 0;
                }
            }
        });
    </script>
    {{-- <script>
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
                    serviciessearch: 0,
                    modalVisible: false,
                    someModal: ""
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
                    coment: function(id) {
                        this.$http.get(api_comentarios + '/' + id)
                            .then(function(json) {
                                console.log(json);
                                this.comments = json.body;
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
                    },
                    openDivComment: function(id) {
                        const dominio = "http://localhost/admin/public/";
                        const nuevaRuta = "comments?id="+id;
                        window.location.assign(nuevaRuta);
                    }
                },
                computed: {}
            })
        }
    </script> --}}
@endpush
