<?php

namespace App\Http\Controllers;

use App\Models\ExamPaper;
use App\Models\Lecture;
use App\Models\Semester;
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
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestLectures = Lecture::orderBy('created_at', 'desc')
                                 ->take(10)
                                 ->with(['subject', 'semester'])
                                 ->get();
        $latestExamPapers = ExamPaper::orderBy('created_at', 'desc')
                                     ->take(10)
                                     ->with(['subject'])
                                     ->get();
        $semesters = Semester::all();
        return view('home', compact('latestLectures', 'latestExamPapers','semesters'));
    }
}
