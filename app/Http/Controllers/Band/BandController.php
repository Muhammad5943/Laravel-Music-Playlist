<?php

namespace App\Http\Controllers\Band;

use App\Models\Band;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function create()
    {
        $genres = Genre::get();

        return view('bands.create', [
            'genres' => $genres,
            'band' => new Band,
            'submitLabel' => 'Create'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // dd($request->genres)
            'name' => 'required|string|unique:bands,name',
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,png,gif,jpg' : '',
            'genres' => 'required|array'
        ]);

        $band = Band::create([
            'name' => $request->name,
            'slug' => Str::slug(request('name')),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('images/band') : null
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success','Band was created');
    }

    public function table()
    {
        return view('bands.table', [
            'bands' => Band::latest()->paginate(15),
        ]);
    }

    public function edit(Band $band)
    {
        // dd($band);

        return view('bands.edit', [
            'band' => $band,
            'genres' => Genre::get(),
            'submitLabel' => 'Update'
        ]);
    }

    public function update(Band $band, Request $request)
    {
        $request->validate([
            // dd($request->genres)
            'name' => 'required|string|unique:bands,name,'. $band->id,
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,png,gif,jpg' : '',
            'genres' => 'required|array'
        ]);

        if (request('thumbnail')) {

            Storage::delete($band->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('images/band');

        } elseif($band->thumbnail) {

            $thumbnail = $band->thumbnail;
        
        } else {
        
            $thumbnail = null;
        
        }
        
        $band->update([
            'name' => $request->name,
            'slug' => Str::slug(request('name')),
            'thumbnail' => $thumbnail
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success','Band was updated');
    }

    public function destroy(Band $band)
    {
        dd($band);
        Storage::delete($band->thumbnail);
        $band->genres()->detach();
        $band->delete();
    }
}
