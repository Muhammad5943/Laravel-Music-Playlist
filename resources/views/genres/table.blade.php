@extends('layouts.backend', ['title' => $title])

@section('content')
    @include('alert')

    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Band</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($genres as $index => $genre)
                        <tr>
                            <td>{{ $genres->firstItem() + $index }}</td>
                            <td>{{ $genre->name }}</td>
                            <td>{{ $genre->bands_count }}</td>
                            <td>
                                <a href="{{ route('genres.edit', $genre->slug) }}" class="btn btn-primary btn-sm">Edit</a>
                                <div endpoint="{{ route('genres.delete', $genre->slug) }}" class="delete d-inline"></div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $genres->links() }}
        </div>
    </div>
@endsection