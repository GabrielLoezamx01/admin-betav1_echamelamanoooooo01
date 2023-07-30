@extends('site.layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-6 ">
                <div class="m-5">
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ asset('storage/fotos/' . $publicaciones['photo']) }}" alt="Foto"
                            class="rounded-circle me-3" width="40" height="40">
                        <h6 class="card-subtitle">{{ $publicaciones['name'] }} {{ $publicaciones['last_name'] }}</h6>
                    </div>
                </div>
                <div class="mt-5 m-5">
                    <p>
                        {{ $publicaciones['content'] }}
                    </p>
                    <div class="card-header card">
                        <p class="fw-light">
                            Dirrecion: {{ $publicaciones['andress'] }}
                        </p>
                        <p class="fw-bold">
                            Servicio: {{ $publicaciones['nombre_servicio'] }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center">
            <button class="btn btn-dark">Ofrecer Servicio</button>
        </div>
        <hr>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Comentarios</h5>
                            <hr>
                            @foreach ($database as $item)
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('storage/fotos/' . $item->photo) }}" alt="Foto"
                                            class="rounded-circle me-3" width="40" height="40">
                                        <h6 class="card-subtitle">{{ $item->name }} {{ $item->last_name }}</h6>
                                    </div>
                                    <p class="card-text">{{ $item->comentario }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">{{ $item->date }}</small>
                                        <div>
                                            <button class="btn btn-sm btn-outline-danger me-2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="mt-5">
                                <form method="post" action="{{ route('newComment') }}">
                                    @csrf
                                    <input type="hidden" name="idp" value="{{ $publicaciones['publications_id'] }}">
                                    <input type="hidden" name="uuidc" value="{{ $publicaciones['id_user'] }}">
                                    <textarea class="form-control" name="contenido" id="" cols="20" rows="6"></textarea>
                                    <button class="btn btn-dark mt-3">Agregar Comentario</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('child-scripts')
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
