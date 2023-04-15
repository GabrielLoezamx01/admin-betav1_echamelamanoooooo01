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

            <form class="uk-form-stacked">

                <label class="uk-form-label" for="nombre">Nombre:</label>
                <input class="uk-input" type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>

                <label class="uk-form-label" for="email">Correo electrónico:</label>
                <input class="uk-input" type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>

                <label class="uk-form-label" for="telefono">Teléfono:</label>
                <input class="uk-input" type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono" required>

                <label class="uk-form-label" for="mensaje">Mensaje:</label>
                <textarea class="uk-textarea" id="mensaje" name="mensaje" placeholder="Escriba aquí su mensaje" required></textarea>

                <button class="uk-button uk-button-primary" type="submit">Enviar</button>

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
