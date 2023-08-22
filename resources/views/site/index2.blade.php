@extends('site.layouts.master')
@section('content')
    <div id="vue">
        <section class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                @if (session('type_user') == 'C')
                    <div class="border-0 ">
                        <div class="card-body p-3 shadow rounded-3">
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
                @foreach ($post as $key => $data)
                    <div class="row mt-5 shadow">
                        <div class="col-md-3 mt-5 text-center">
                            <img src="{{ asset('storage/sucursales/' . $data->image) }}" alt="Imagen"
                                class="circular-image img-fluid">
                                <h5 class="fw-bold mt-3">
                                    {{ $data->name_branch }}</h5>
                                    <label for="" class="fw-light" style="font-size: 12px">
                                        {{$data->description}}
                                    </label>
                                    <div class="mt-5">
                                        <label for="" class="fw-light" style="font-size: 12px">
                                            {{$data->city}},  {{$data->address}}, {{$data->postal_code}}
                                        </label>
                                    </div>
                        </div>
                        <div class="col-md-7 mt-5">
                            <div>
                                <h1>
                                    {{$data->Tittle}}
                                </h1>
                            </div>
                            <div class="mt-3">
                                <p class="fw-light text-justify">{{ $data->contenido }}</p>
                            </div>
                            <div class="mt-5 text-center">
                                <img src="{{ asset('storage/sucursales/' . $data->image) }}" alt="Imagen"
                                    class="img-fluid" style="height: 500px">
                            </div>
                            <div class="p-5"></div>
                        </div>
                    </div>
                    <div>
                        {{ $data->img_1 }}
                        {{ $data->likes }}
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
