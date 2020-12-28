@extends('layouts.backend', ['title' => $title])
@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <form action="{{ route('albums.edit', $album) }}" method="post">
                @csrf
                @method('PUT')
                
                @include('albums.partials.form-control')
            </form>
        </div>
    </div>
@endsection