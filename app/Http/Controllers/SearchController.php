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
        $search = request()->input('query');
        if ($search){
            $lectures = Lecture::where('title', 'LIKE', "%{$search}%")->get();
            $subjects = Subject::where('Subject_name', 'LIKE', "%{$search}%")->get();
            return view('search', compact('lectures', 'subjects','search'));
        }
        else{
            $lectures= null;
            $subjects= null;
            return view('search', compact('lectures', 'subjects', 'search'))->with('error', 'No results found');
        }
    }

}
