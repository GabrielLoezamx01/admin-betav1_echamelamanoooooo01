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
                {!! Form::text('nombre', old('nombre'), ['class' => 'form-control custom-focus', 'autocomplete' => 'off', 'required']) !!}
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Dirección </p>
                {!! Form::text('direccion', old('direccion'), ['class' => 'form-control custom-focus', 'autocomplete' => 'off', 'required']) !!}
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Ciudad </p>
                {!! Form::text('ciudad', old('ciudad'), ['class' => 'form-control custom-focus', 'autocomplete' => 'off', 'required']) !!}
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Código postal </p>
                {!! Form::text('postal', old('postal'), ['class' => 'form-control custom-focus', 'autocomplete' => 'off', 'required']) !!}
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Imagen de perfil</p>
                {!! Form::file('img', ['class' => 'form-control custom-focus', 'autocomplete' => 'off', 'required']) !!}
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">RFC</p>
                {!! Form::text('rfc', null, ['class' => 'form-control custom-focus', 'autocomplete' => 'off', 'placeholder' => 'Si no tienes RFC INGRESA 01']) !!}
            </div>
            <div class="mb-3">
                <p class="card-title text-title fw-ligh">Descripción</p>
                {!! Form::textarea('descripcion', old('descripcion'), ['class' => 'form-control custom-focus', 'cols' => '30', 'rows' => '10', 'required', 'maxlength' => '400']) !!}
            </div>
            <div class="mb-3 text-center">
                {!! Form::button('Registrar', ['class' => 'btn btn-dark p-2', 'type' => 'submit']) !!}
            </div>
        </div>
    </div>
    </form>
