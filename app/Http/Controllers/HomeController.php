<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        return view('home', [
            'bands' => Band::with('album')->latest()->paginate(9)
        ]);
    }
}
