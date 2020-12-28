@extends('layouts.backend', compact('title'))

@section('content')
    @include('alert')

    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <form action="{{ route('genres.edit', $genre->slug) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $genre->name }}" />
                </div>
                
                @error('name')
                    <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@endsection