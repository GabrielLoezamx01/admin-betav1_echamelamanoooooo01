    <h2 class="text-center fw-bold">Sucursales Destacadas</h2>
        <div v-for="sucursal in sucursales" class="shadow">
            <div class="p-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="imagen-contenido">
                            <img :src="'storage/sucursales/' + sucursal.image" class="imagen">
                            <div class="title-overlay">
                                <b>
                                    @{{ sucursal.name_branch }}
                                </b>
                                @include('site.rang')
                                <label for="" class="fw-light">
                                 @{{ sucursal.name }}
                                </label>
                                <div class="text-center mt-2">
                                    <button class="btn btn-warning">
                                        Ver
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-3"> --}}


                        {{-- </div> --}}
                    </div>
                    {{-- <div class="col-md-6">
                        <p class="fw-light"> --}}
                        {{-- </p>

                    </div> --}}
                </div>

            </div>
        </div>
