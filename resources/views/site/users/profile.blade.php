@extends('site.layouts.master')
@section('title', 'Perfil')
@section('content')
    <div id="vue">
        @if (session('name') == '' OR session('photo') == '')
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Importante a completar sus datos</p>
            </div>
        @endif
        <div class="uk-container">
            <h1>Tu informacion</h1>

            <form class="uk-form-horizontal" method="post" action="{{route('data_clients')}}" enctype="multipart/form-data" >
                @csrf
                <div class="uk-margin">
                    <label class="uk-form-label" for="nombre">Nombres:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" id="nombre" name="nombre" placeholder="Ingrese sus nombres" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="apellidos">Apellidos:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" id="apellidos" name="apellidos" placeholder="Ingrese sus apellidos" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="telefono">Teléfono:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono" required maxlength="12" pattern="\d{1,12}">
                    </div>
                </div>

                {{-- <div class="uk-margin">
                    <label class="uk-form-label" for="correo">Correo electrónico:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="email" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required>
                    </div>
                </div> --}}

                <div class="uk-margin">
                    <label class="uk-form-label" for="direccion">Dirección:</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea" id="direccion" name="direccion" placeholder="Ingrese su dirección completa" required></textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="foto">Foto de perfil:</label>
                    <div class="uk-form-controls">
                        <div class="uk-margin uk-width-medium uk-text-center uk-inline">
                            <div class="uk-form-custom" uk-form-custom>
                                <input type="file" id="foto" name="foto">
                                <button class="uk-button uk-button-default" type="button" tabindex="-1">Seleccionar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin">
                    <button class="uk-button uk-button-primary" type="submit">Enviar</button>
                </div>

            </form>
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
                    coment: function (id){
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
