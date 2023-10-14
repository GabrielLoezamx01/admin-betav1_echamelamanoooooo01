<div>
    <h2 class="text-center fw-bold fs-5">Sucursales Destacadas</h2>
    <div v-for="sucursal in sucursales" class="shadow mt-5 rounded-3">
        <div class="p-1">
            <div class="row ">
                <div class="col-md-12 rounded-3">
                    <div class="imagen-contenido rounded-3">
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
                                <a href="sucursal?id_branch=">
                                    <button class="btn btn-warning">
                                        Ver
                                    </button>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
