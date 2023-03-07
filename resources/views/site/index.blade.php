@extends('site.layouts.master')
@section('content')
<div id="vue">
    @{{apiResponse}}
    <div class="uk-container uk-padding-small ">
        <div class="uk-column-1">
            <div class="uk-margin uk-card uk-card-default uk-card-body">
                <legend class="uk-legend">Nueva Publicacion</legend>
                <textarea class="uk-textarea" rows="5"></textarea>
                <button class="uk-button uk-button-default uk-margin-top">Publicar</button>
            </div>
        </div>
    </div>
    <div class=" uk-text-center uk-text-large">Publicaciones recientes</div>
    <div v-for="post in apiResponse">
        <div class="uk-container uk-padding-small ">
            <article class="uk-comment uk-comment-primary" role="comment">
                <header class="uk-comment-header">
                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-comment-avatar" src="https://getuikit.com/docs/images/avatar.jpg" width="80" height="80" alt="">
                        </div>
                        <div class="uk-width-expand">
                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">@{{post.name}} @{{post.last_name}}</a></h4>
                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                <li><a href="#">@{{post.date}}</a></li>
                            </ul>
                        </div>
                    </div>
                </header>
                <div class="uk-comment-body">
                    <p>@{{post.content}} </p>
                </div>
                <footer>
                    <button class="uk-button uk-button-default uk-margin-top">Comentar</button>
                    <button class="uk-button uk-button-secondary uk-margin-top">Me interesa</button>
                </footer>
            </article>
        </div>
    </div>
    <button>Agregar a favorito</button>
</div>

@endsection
@push('child-scripts')
    <script>
        var api = 'Api_publications';
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
                    conectadi: 'VUE JS',
                    name: '',
                    save: true,
                    edit: false,
                    uuid: ''
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
                    success_alert: function(){
                        swal({
                                        title: "Good job!",
                                        text: "You clicked the button!",
                                        icon: "success",
                                        button: "Aww yiss!",
                                    });
                    },
                    close_modal:function(){
                        $('#modal').modal('hide');
                        this.name = '';
                    }
                },
                computed: {}
            })
        }
    </script>
@endpush
