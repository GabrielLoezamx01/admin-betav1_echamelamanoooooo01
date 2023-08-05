@extends('site.layouts.master')
@section('title', 'Perfil')
@section('content')
    <div id="vue">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="p-5">
                        @if (session('name') == '' or session('photo') == '')
                            <p class="fw-bold fs-4">Importante a completar sus datos</p>
                        @endif
                        <form class="form-control" method="post" action="{{ route('data_clients') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="">Nombres:</label>
                                <input class="form-control custom-focus" type="text" id="nombre" name="nombre"
                                placeholder="Ingrese sus nombres" required value="{{old('nombre')}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Apellidos:</label>
                                <input class="form-control custom-focus" type="text" id="apellidos" name="apellidos"
                                placeholder="Ingrese sus apellidos" required value="{{old('apellidos')}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Teléfono:</label>
                                <input class="form-control custom-focus" type="tel" id="telefono" name="telefono"
                                placeholder="Ingrese su número de teléfono" required maxlength="12"
                                pattern="\d{1,12}" value="{{old('telefono')}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Codigo Postal:</label>
                                <input class="form-control custom-focus" type="text" id="apellidos" name="postal"
                                placeholder="Ingrese su codigo postal" required value="{{old('postal')}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Estado:</label>
                                <input class="form-control custom-focus" type="text" id="apellidos" name="estado"
                                placeholder="Ingrese su estado" required value="Yucatán">
                            </div>
                            <div class="mb-3">
                                <label for="">Ciudad:</label>
                                <input class="form-control custom-focus" type="text" id="apellidos" name="ciudad"
                                placeholder="Ingrese su ciudad" required value="{{old('ciudad')}}" >
                            </div>
                            <div class="mb-3">
                                <label for="">Dirección:</label>
                                <textarea class="form-control custom-focus" id="direccion" name="direccion" placeholder="Ingrese su dirección completa" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Foto de perfil:</label>
                                <input type="file" id="foto" name="foto" class="form-control custom-focus" accept="image/*">
                            </div>
                            <div class="m-3">
                                  <button class="btn btn-dark" type="submit">Enviar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('child-scripts')
    <script>
        var api = 'Api_publications'; {
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
                    conectadi: 'VUE JS',
                    name: '',
                    save: true,
                    edit: false,
                    uuid: '',
                    newPost: '',
                    divcomment: false
                },
                created: function() {
                    this.getSHOW();
                },
                methods: {
                    getSHOW: function() {
                        this.$http.get(api).then(function(response) {
                            this.apiResponse = response.body
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
                    postnew: function() {
                        if (this.newPost == "") {
                            alert('No puede estar vacio la publicacion');
                        } else {
                            var data = {
                                'content': this.newPost,
                                'uuid': this.generate_uuid()
                            };
                            this.$http.post(api, data)
                                .then(function(json) {
                                    this.newPost = '';
                                    this.getSHOW();
                                });
                        }
                    },
                    coment: function(id) {
                        this.$http.get(api + '/' + id)
                            .then(function(json) {
                                console.log(json.data);
                            });
                    }
                },
                computed: {}
            })
        }
    </script>
@endpush
