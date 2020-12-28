@extends('layouts.backend', compact('title'))

@section('content')
    @include('alert')

    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <form action="{{ route('genres.create') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" />
                </div>
                
                @error('name')
                    <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

@endsection