<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Subject;
use App\Models\ExamPaper;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search()
    {
        $search = request()->query('search');
        if ($search) {
            $lectures = Lecture::where('title', 'LIKE', "%{$search}%")->get();
            $subjects = Subject::where('name', 'LIKE', "%{$search}%")->get();
            $examPapers = ExamPaper::where('title', 'LIKE', "%{$search}%")->get();
        } else {
            $lectures = Lecture::all();
            $subjects = Subject::all();
            $examPapers = ExamPaper::all();
        }
        return view('search', compact('lectures', 'subjects', 'examPapers', 'search'));
    }

}
