@extends('layouts.backend')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2multiple').select2();
        });
    </script>
@endpush
@section('content')
    @include('alert')
    <div class="card">
        <div class="card-header">New Band</div>
        <div class="card-body">
            <form action="{{ route('bands.edit', $band->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include(' bands.partials.form-control')

            </form>
        </div>
    </div>
@endsection