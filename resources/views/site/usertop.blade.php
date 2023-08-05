<div class="text-center">
    <h2>Sucursales Destacadas</h2>
    <div class="position-fixed  bg-light p-3">
        <div v-for="sucursal in sucursales">
            <div class="card shadow">
                <div class="row">
                    <div  class="col-md-6">
                        <img :src="'storage/sucursales/' + sucursal.image" class="fija-img">
                        <div class="mt-3">
                            <b>
                                @{{sucursal.name_branch}}
                            </b>
                          @include('site.rang')
                            {{-- <label for="andress" class="fw-light fs-6">
                                @{{sucursal.city}} ,
                                @{{sucursal.address}} ,
                                @{{sucursal.postal_code}}
                            </label> --}}

                        </div>

                    </div>
                    <div  class="col-md-6">
                        <p class="fw-light">
                            @{{sucursal.name}}
                        </p>
                        <button class="btn btn-dark">
                            Ver
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
