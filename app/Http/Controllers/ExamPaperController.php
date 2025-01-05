<?php

namespace App\Http\Controllers;

use App\Models\ExamPaper;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:upload files')->only(['create', 'store']);
        $this->middleware('permission:edit files')->only(['edit', 'update']);
        $this->middleware('permission:delete files')->only('destroy');
        $this->middleware('permission:download files')->only('download');
    }
    public function index(Subject $subjects)
    {
        $subjects = Subject::all();
        $examPapers = ExamPaper::with('subject');
        $semesters = Semester::all();
        return view('exam-papers.index', compact('examPapers', 'subjects', 'semesters'));
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
            'description' => 'nullable|string',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        $file_path = $request->file('pdf_file')->store('exam-papers', 'public');

        ExamPaper::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
            'file_path' => $file_path,
        ]);

        return redirect()->route('exam-papers.index')->with('success', 'Exam paper uploaded successfully!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamPaper $examPaper, Subject $subjects)
    {
        $subjects = Subject::all();

        return view('exam-papers.edit', compact('examPaper', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamPaper $examPaper)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'description' => 'nullable|string',
            'pdf_file' => 'mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('pdf_file')) {
            $file_path = $request->file('pdf_file')->store('files', 'public');
        } else {
            $file_path = $examPaper->file_path;
        }

        $examPaper->update([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
            'file_path' => $file_path,
        ]);

        return redirect()->route('exam-papers.index')->with('success', 'Exam paper updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamPaper $examPaper)
    {
        if ($examPaper->file_path) {
            Storage::disk('public')->delete($examPaper->file_path);
        }

        $examPaper->delete();
        return redirect()->route('exam-papers.index')->with('success', 'Exam paper deleted successfully!');
    }

    public function download($id)
    {
        $examPaper = ExamPaper::findOrFail($id); // Find the exam paper or throw a 404 error

        if (Storage::disk('public')->exists($examPaper->file_path)) {
            
            return response()->download(storage_path('app/public/' . $examPaper->file_path), $examPaper->title . '.pdf');
        }

        return redirect()->back()->with('error', 'File not found!');
    }
}
