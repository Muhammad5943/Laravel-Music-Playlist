@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($bands as $band)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">           
                        {{-- cara1 --}}
                        {{-- <img src="{{ asset("storage/". $band->thumbnail) }}" alt="{{ $band->name }}" class="image-cap-top"> --}}

                        {{-- cara2 menggunakan model dengan method tertentu --}}
                        <img style="object-fit:cover; object-position: center" height="230px" src="{{ $band->picture }}" alt="{{ $band->name }}" class="card-img-top">
                        
                        <div>
                            <a href="{{ route('bands.show', $band) }}">
                                {{ $band->name }}
                            </a>

                            <div>
                                {{ optional($band->album)->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $bands->links() }}
</div>
@endsection
