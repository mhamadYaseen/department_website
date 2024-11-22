<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestLectures = Lecture::with(['subject', 'semester'])
                                 ->latest()
                                 ->take(10)
                                 ->get();
                                 
        return view('home', compact('latestLectures'));
    }
}
