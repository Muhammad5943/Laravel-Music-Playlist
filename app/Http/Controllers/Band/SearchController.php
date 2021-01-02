<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Models\Lyric;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return redirect('/');
        } else {
            $lyrics = Lyric::where("title", "LIKE", "%{$keyword}%")
                            ->orWhereHas('band', function($q) use ($keyword){
                                return $q->where('name', 'LIKE', "%{$keyword}%");
                            })->orWhereHas('album', function($q) use ($keyword){
                                return $q->where('name', 'LIKE', "%{$keyword}%");
                            })->paginate(16);
        }
        
        return view('search', [
            'lyrics' => $lyrics,
            'keyword' => $keyword
        ]);
    }
}
