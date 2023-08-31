@extends('site.layouts.master')
@section('content')
    @push('styles')
    @endpush
    <div id="vue" class="container mt-5">
        <div class="col-md-12 mt-5">
            {{$branch}}
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
