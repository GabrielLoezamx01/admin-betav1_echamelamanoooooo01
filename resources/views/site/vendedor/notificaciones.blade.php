@extends('site.layouts.master')
@section('content')
    <div id="vue" class="row">
        <div class="col-md-3 animate__animated animate__fadeInLeft">
            @include('site.sidebar')
        </div>
        <div class="col-md-7 mt-5">

            <div class="card">
                <div class="container mt-5">
                    <h1>Notificaciones</h1>
                    <ul class="list-group">
                        <!-- Ejemplo de notificación -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @foreach ($data as $item)
                                <div>
                                    <h5>¡Alguien está solicitando un servicio que actualmente se encuentra disponible! ¡Aprovecha esta oportunidad para brindarlo!  </h5>
                                </div>
                                <a href="comments?id={{$item->publications_id}}&notify=true&user={{$item->id_seller}}&idc={{$item->uuid}}">
                                    <span class="badge bg-dark p-2">Ver</span>
                                </a>

                            @endforeach

                        </li>
                        <!-- Agrega más elementos li para más notificaciones -->
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-2">
            @include('site.usertop')
        </div>
    </div>
@endsection
@push('child-scripts')
@endpush
