@extends('layouts.app')

@section('content')
{{-- FALTA METODO DE BUSQUEDA EN LA TABLA --}}
    <div class="row" id="vue">
        @{{apiResponse}}
        <hr>
        @{{apiResponse2}}

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="p-2">
                        <button class="btn btn-success" @click="modal(true)">Nuevo</button>
                    </div>
                    <div class="text-center">
                        <h5>Lista Sub Categoria</h5>
                    </div>
                </div>
                <div class="card-container table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="index in apiResponse">
                                <td>@{{ index.sub_name }}</td>
                                <td>
                                    <button class="btn btn-info"><i class="fas fa-edit"
                                            @click="show_item(index.id_sub)"></i></button>
                                    <button class="btn btn-danger" @click="delete_item(index.id_sub)"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"></h5>
                        <button type="button"  @click="close_modal()"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="mt-2">Nombre</label>
                        <input type="name" v-model="name" class="form-control mt-2" placeholder="Nombre">
                        <label for="" class="mt-2">Categoria</label>
                        <select v-model="select" class="form-control mt-2" id="sele">
                            <option v-for="sele in apiResponse2" :value="sele.cat_uuid">@{{sele.cat_name}}</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary text-center" data-bs-dismiss="modal" v-if="save == true"
                        @click="save_item()">Ok</button>
                    <button type="button" class="btn btn-primary text-center" data-bs-dismiss="modal" v-if="edit == true"
                        @click="update_item()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('child-scripts')
    <script>
        var api = 'Api_subCategory';
        var api2 = 'Api_category';
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
                    apiResponse2: [],
                    conectadi: 'VUE JS',
                    select:{},
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
                        this.$http.get(api2).then(function(response) {
                            this.apiResponse2 = response.body
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
                                console.log(json);
                                this.name = json.data.sub_name;
                                this.uuid = json.data.id_sub
                            });
                    },
                    update_item: function() {
                        if (!this.select == '' && !this.name == '') {
                            var data = {
                                sub_name: this.name,
                                id_category: this.select,
                            };
                            this.$http.patch(api + '/' + this.uuid, data)
                                .then(function(json) {
                                    console.log(json);
                                    // if (json.status == 200) {
                                    //     this.getSHOW();
                                    //     this.close_modal();
                                    //     this.success_alert();
                                    // }
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
