@extends('site.layouts.master')
@section('content')
    <div id="vue" class="row">
        <div class="col-md-3 animate__animated animate__fadeInLeft">
            @include('site.sidebar')
        </div>
        <div class="col-md-7">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam consequuntur ad id. Est minus nam ducimus officiis non vel eveniet dolore voluptates consectetur adipisci. Quos saepe perspiciatis eos ducimus pariatur.
        </div>
        <div class="col-md-2">
            @include('site.usertop')
        </div>
    </div>
@endsection
@push('child-scripts')


@endpush
