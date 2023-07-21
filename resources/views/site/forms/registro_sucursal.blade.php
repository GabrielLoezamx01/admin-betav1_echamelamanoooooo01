<form method="post" action="{{route('create_sucursal')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="mt-3">
            <h5>Primeros pasos</h5>
        </div>
        <div class="col-md-6 mt-3">
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Servicio</p>
                <select v-model="servicies" class="form-control custom-focus " id="servicies" name="servicio" required>
                    <option class="select-option" v-for="select in apiServicios" :value="select.id">
                        @{{ select.name }}</option>
                </select>
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Nombre</p>
                <input type="text" value="{{old('nombre')}}" name="nombre" class="form-control custom-focus" autocomplete="off" required >
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Calle</p>
                <input type="text" value="{{old('calle')}}" name="calle" class="form-control custom-focus" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Dirección </p>
                <input type="text" value="{{old('direccion')}}" name="direccion" class="form-control custom-focus" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Ciudad </p>
                <input type="text" value="{{old('ciudad')}}" name="ciudad" class="form-control custom-focus" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Código postal </p>
                <input type="text" value="{{old('postal')}}" name="postal" class="form-control custom-focus" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Imagen de perfil</p>
                <input type="file"  name="img" class="form-control custom-focus" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">RFC</p>
                <input type="text"  name="rfc" class="form-control custom-focus" autocomplete="off" placeholder="Opcional">
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Descripción</p>
                <textarea  name="descripcion" class="form-control custom-focus" id="" cols="30" rows="10" required
                    maxlength="400">
                    {{old('descripcion')}}
                </textarea>
            </div>
            <div class="mb-3 text-center">
                <button class="btn btn-dark p-2">Registrar</button>
            </div>
        </div>
    </div>

</form>
