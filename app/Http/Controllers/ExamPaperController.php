<?php

namespace App\Http\Controllers;

use App\Models\ExamPaper;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examPapers = ExamPaper::all();
        return view('exam-papers.index', compact('examPapers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Subject $subjects)
    {
        $subjects = Subject::all();
        return view('exam-papers.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        $file_path = $request->file('pdf_file')->store('files', 'public');

        ExamPaper::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'file_path' => $file_path,
        ]);

        return redirect()->route('exam-papers.index')->with('success', 'Exam paper uploaded successfully!');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamPaper $examPaper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamPaper $examPaper)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamPaper $examPaper)
    {
        //
    }
}
