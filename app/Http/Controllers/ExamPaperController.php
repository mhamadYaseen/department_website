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
            'pdf_file' => 'required|mimes:pdf|max:10240',
        ]);
        if (!$request->description) {
            $request->merge(['description' => 'there is no description']);
        }

        // Store the file in the R2 disk
        $file_path = $request->file('pdf_file')->store('files', 'r2');

        // Save the exam paper in the database
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
    public function edit(ExamPaper $examPaper)
    {
        $subjects = Subject::all();

        return view('exam-papers.edit', compact('examPaper', 'subjects'));
    }

    /**
     * Update the specified exam paper in storage.
     */
    public function update(Request $request, ExamPaper $examPaper)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'description' => 'nullable|string',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('pdf_file')) {
            // Delete the old file from R2 if it exists
            if ($examPaper->file_path) {
                Storage::disk('r2')->delete($examPaper->file_path);
            }

            // Store the new file in R2
            $file_path = $request->file('pdf_file')->store('files', 'r2');
        } else {
            // Keep the existing file path if no new file is uploaded
            $file_path = $examPaper->file_path;
        }

        // Update the exam paper in the database
        $examPaper->update([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
            'file_path' => $file_path,
        ]);

        return redirect()->route('exam-papers.index')->with('success', 'Exam paper updated successfully!');
    }

    /**
     * Remove the specified exam paper from storage.
     */
    public function destroy(ExamPaper $examPaper)
    {
        // Delete the file from R2 if it exists
        if ($examPaper->file_path) {
            Storage::disk('r2')->delete($examPaper->file_path);
        }

        // Delete the exam paper record from the database
        $examPaper->delete();

        return redirect()->route('exam-papers.index')->with('success', 'Exam paper deleted successfully!');
    }

    /**
     * Download the specified exam paper.
     */
    public function download(ExamPaper $paper)
    {
        if (Storage::disk('r2')->exists($paper->file_path)) {
            // Fetch the file content from R2
            $fileContent = Storage::disk('r2')->get($paper->file_path);

            // Create the download response with appropriate headers
            return response($fileContent, 200, [
                'Content-Type' => Storage::disk('r2')->mimeType($paper->file_path),
                'Content-Disposition' => 'attachment; filename="' . basename($paper->file_path) . '"',
            ]);
        }

        // Redirect back if the file does not exist
        return redirect()->back()->with('error', 'File not found.');
    } 
}
