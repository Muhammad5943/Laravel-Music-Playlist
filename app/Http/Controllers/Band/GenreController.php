<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\Band\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function create()
    {
        return view('genres.create', [
            'title' => 'New Genre'
        ]);
    }

    public function store(GenreRequest $request)
    {
        Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success', 'Genre was created');
    }

    public function table()
    {
        return view('genres.table', [
            'genres' => Genre::latest()->paginate(10),
            'title' => 'All Music Genre'
            ]);
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', [
            'title' => 'Update Genre: '. $genre->name,
            'genre' => $genre
        ]);
    }

    public function update(Genre $genre, GenreRequest $request)
    {
        $genre->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('genres.table')->with('success', 'Genre was updated');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
    }
}
