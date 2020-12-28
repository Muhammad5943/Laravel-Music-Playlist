<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\Band\AlbumRequest;
use App\Models\Album;
use App\Models\Band;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function create()
    {
        return view('albums.create', [
            'title' => 'New Album',
            'bands' => Band::get(),
            'submitLabel' => 'Create',
            'album' => new Album
        ]);
    }

    public function store(AlbumRequest $request)
    {

        $band = Band::find(request('band'));

        Album::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'band_id' => request('band'),
            'year' => request('year')
        ]);

        return redirect()->route('albums.table')->with('status','Album was created into ' . $band->name);
    }

    public function table()
    {
        return view('albums.table', [
            'albums' => Album::paginate(15),
            'title' => 'Album'
        ]);
    }

    public function edit(Album $album)
    {
        return view('albums.edit', [
            'title' => "Edit album: { $album->name }",
            'bands' => Band::get(),
            'album' => $album,
            'submitLabel' => 'Update'
        ]);
    }

    public function update(Album $album, AlbumRequest $request)
    {
        $album->update([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'band_id' => request('band'),
            'year' => request('year')
        ]);

        return redirect()->route('albums.table')->with('status','Album was updated');
    }

    // ini adalah sebuah API
    public function getAlbumsByBandId(Band $band)
    {
        return $band->albums;
    }

    public function destroy(Album $album)
    {
        $album->delete();
    }
}
