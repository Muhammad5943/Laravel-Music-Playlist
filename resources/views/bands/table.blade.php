@extends('layouts.backend')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bands as $band)
                <tr>
                    <td>{{ $bands->count() * ($bands->currentPage() - 1) + $loop->iteration }}</td>
                    <td>{{ $band->name }}</td>
                    <td>{{ $band->genres()->get()->implode('name', ', ') }}</td>
                    <td>
                        <a href="{{ route('bands.edit', $band->slug ) }}" class="btn btn-primary">Edit</a>
                        <div endpoint="{{ route('bands.delete', $band) }}" class="delete d-inline"></div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bands->links() }}

@endsection