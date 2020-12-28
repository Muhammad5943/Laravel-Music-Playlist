<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Models\Band;
use App\Models\Lyric;
use Illuminate\Support\Str;

class LyricController extends Controller
{
    public function create()
    {
        return view('lyrics.create', [
            'title' => 'New Lyric'
        ]);
    }

    public function store()
    {
        request()->validate([
            'album' => 'required',
            'band' => 'required',
            'body' => 'required',
            'title' => 'required'
        ]);

        $band = Band::find(request('band'));

        $band->lyrics()->create([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'album_id' => request('album')
        ]);

        return response()->json(['message' => 'The lyrics was created into band '. $band->name]);
    }

    public function table(Lyric $lyric)
    {
        return view('lyrics.table', [
            'lyrics' => $lyric,
        ]);
    }
}
