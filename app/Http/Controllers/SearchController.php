<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Subject;
use App\Models\ExamPaper;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search()
    {
        $search = request()->input('query');
        if ($search){
            Cache::remember("search_{$search}", 60, function () use ($search) {
                return Lecture::where('title', 'like', "%{$search}%")->get();
            });
            
            $lectures = Lecture::where('title', 'LIKE', "%{$search}%")->get();
            $subjects = Subject::where('Subject_name', 'LIKE', "%{$search}%")->get();
            $exam_papers = ExamPaper::where('title', 'LIKE', "%{$search}%")->get();
            return view('search', compact('lectures', 'subjects','exam_papers','search'));
        }
        else{
            $lectures= null;
            $subjects= null;
            return view('search', compact('lectures', 'subjects', 'search'))->with('error', 'No results found');
        }
    }

}
