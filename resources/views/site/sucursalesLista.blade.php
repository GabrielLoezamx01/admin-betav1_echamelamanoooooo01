@extends('site.layouts.master')
@section('content')
    <div class="row">
        @foreach ($one as $item )
            <div class="col-md-10 card shadow">
                <header class>
                    <img src="{{asset('storage/sucursales/'.$item->image)}}" class="img-fluid w-50  " alt="Foto de la Sucursal">
                </header>
                <div class="card-body">
                    <h5 class="fw-bold">
                        {{$item->name_branch}}
                    </h5>
                    <p class="fw-light">
                        {{$item->description}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@push('child-scripts')

@endpush

