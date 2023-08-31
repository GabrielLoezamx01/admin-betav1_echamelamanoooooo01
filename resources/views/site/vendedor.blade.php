@extends('site.layouts.master')
@section('content')
    @push('styles')
        <style>
            /*** ESTILOS BOTÓN SLIDE TOP ***/
            .ov-btn-slide-top {
                background: white;
                border: none;
                border: 1px solid #249f11;
                /* tamaño y color de borde */
                /* padding: 16px 20px; */
                width: 70px;
                height: 40px;
                border-radius: 3px;
                /* redondear bordes */
                position: relative;
                z-index: 1;
                overflow: hidden;
                display: inline-block;
                /* box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.1); */
            }

            .ov-btn-slide-top:hover {
                color: #fff;
                /* color de fuente hover */
            }

            .ov-btn-slide-top::after {
                content: "";
                background: #249f11;
                /* color de fondo hover */
                position: absolute;
                z-index: -1;
                padding: 16px 20px;
                display: block;
                left: 0;
                right: 0;
                top: -100%;
                bottom: 100%;
                -webkit-transition: all 0.35s;
                transition: all 0.35s;
            }

            .ov-btn-slide-top:hover::after {
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
                -webkit-transition: all 0.35s;
                transition: all 0.35s;
            }
        </style>
    @endpush
    <div id="vue" class="container mt-5">

        <div class="col-md-12 mt-5">
            @if (count($branch) == 0)
                <section class="card">
                    <header class="text-center bg-dark">
                        <h3 class="p-3 fw-bold" style="color:#FFFF00;">¡Registra tu primera sucursal de forma <span
                                class="fs-2">gratuita!</span></h3>
                    </header>
                    <div class="mt-3 p-2">
                        @include('site.forms.registro_sucursal')
                    </div>
                    <footer class="text-center p-3">
                        <p class="text-warning">Asegúrate de ingresar toda la información requerida.</p>
                    </footer>
                </section>
            @else
                @isset($branch)
                    <section class="row mt-5  justify-content-center">
                        <h3 class="p-3 fw-bold text-center">Mis Sucursales</h3>
                        <div class="p-5">
                            {{-- <button class="elegant-button outlined" data-toggle="modal" data-target="#exampleModal">Nueva
                                Sucursal</button> --}}
                        </div>
                        @foreach ($branch as $key => $data)
                            <div class="col-md-3 text-center">
                                   <div class="bg-white shadow">
                                        {!! Html::image('storage/sucursales/' . $data->image, $data->name_branch, [
                                            'title' => $data->name_branch,
                                            'class' => 'img-fluid shadow w-50 circular-image mt-5',
                                            'style' => 'border-color: white',
                                        ]) !!}
                                        <p class="fw-bold text-center mt-4 fs-4">
                                            {{ $data->name_branch }}
                                        </p>

                                        {!! Form::open(['route' => 'sucursal', 'method' => 'GET']) !!}
                                            @csrf
                                            {!! Form::hidden('id_branch', $data->id_branch) !!}
                                            <div class="text-centerr">
                                                {!! Form::button('<i class="fa fa-cog"></i>', [
                                                    'type'  => 'submit',
                                                    'class' => 'ov-btn-slide-top m-2',
                                                    'title' => 'Ajustes'
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-eye"></i>', [
                                                    'type'  => 'submit',
                                                    'class' => 'ov-btn-slide-top m-2',
                                                    'title' => 'Ver Pefil'
                                                ]) !!}
                                            </div>
                                            <div class="p-5"></div>
                                    {!! Form::close() !!}
                                   </div>
                            </div>
                        @endforeach
                        <div class="p-5"></div>
                    </section>
                @endisset
            @endif
        </div>

    </div>
@endsection
@push('child-scripts')
    <script>
        var serivicios_api = 'api_servicios';
        {
            new Vue({
                el: '#vue',
                http: {
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                },
                data: {
                    apiServicios: [],
                    services: 0,
                },
                created: function() {
                    this.api_servicios();
                },
                methods: {
                    api_servicios: function() {
                        this.$http.get(serivicios_api).then(function(data) {
                            this.apiServicios = data.body;
                        });
                    }
                },
            })
        }
    </script>
@endpush
