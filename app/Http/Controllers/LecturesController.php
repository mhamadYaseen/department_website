<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:upload files')->only(['create', 'store']);
        $this->middleware('permission:edit files')->only(['edit', 'update']);
        $this->middleware('permission:delete files')->only('destroy');
        $this->middleware('permission:download files')->only('download');
    }
    
    public function index()
    {
        $lectures = Lecture::with(['subject', 'semester'])->get();
        $subjects = Subject::with('semester')->get();
        $semesters = Semester::all();
        return view('lectures.index', compact('lectures', 'subjects', 'semesters'));
    }


    public function create(Subject $subjects)
    {
        $subjects = Subject::all(); // Fetch all subjects from the database
        return view('lectures.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'subject_id' => 'required|exists:subjects,id', // Validate that subject_id exists in the subjects table
                'lecturer' => 'required',
                'pdf_file' => 'required|mimes:pdf|max:2048',
            ]);

            // Store the uploaded PDF in the 'public/files' directory and get the path
            $filePath = $request->file('pdf_file')->store('files', 'public');

            // Store the lecture in the database with the subject_id
            $lecture = Lecture::create([
                'title' => $request->title,
                'subject_id' => $request->subject_id, // Use subject_id from the request
                'lecturer' => $request->lecturer,
                'file_path' => $filePath
            ]);
            activity()
                ->causedBy(Auth::user())
                ->performedOn($lecture)
                ->log('created lecture' . $lecture->title);

            return redirect()->route('lectures.index')->with('success', 'Lecture created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating lecture: ' . $e->getMessage())->withInput();
        }
    }


    public function show(Lecture $lecture)
    {
        return view('lectures.index', compact('lecture'));
    }

    public function edit(Lecture $lecture, Subject $subjects)
    {
        $subjects = Subject::all();
        return view('lectures.edit', compact('lecture', 'subjects'));
    }


    public function update(Request $request, Lecture $lecture)
    {
        // Validate input data
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required|exists:subjects,id', // Validate subject_id
            'lecturer' => 'required',
            'pdf_file' => 'nullable|mimes:pdf|max:2048', // Allow pdf to be nullable (optional update)
        ]);

        // Check if a new file is uploaded
        if ($request->hasFile('pdf_file')) {
            // Delete the old file if it exists
            if ($lecture->file_path) {
                Storage::disk('public')->delete($lecture->file_path);
            }

            // Store the new uploaded PDF_file and get the file path
            $filePath = $request->file('pdf_file')->store('files', 'public');
        } else {
            // Keep the old file path if no new file is uploaded
            $filePath = $lecture->file_path;
        }

        // Update the lecture in the database
        $lecture->update([
            'title' => $request->title,
            'subject_id' => $request->subject_id, // Use subject_id field
            'lecturer' => $request->lecturer,
            'file_path' => $filePath // Save the file path
        ]);

        return redirect()->route('lectures.index')->with('success', 'lecture updated successfully!');
    }

    public function destroy(Lecture $lecture)
    {
        // Delete the file from storage
        if ($lecture->file_path) {
            Storage::disk('public')->delete($lecture->file_path);
        }

        // Delete the lecture from the database
        $lecture->delete();

        return redirect()->route('lectures.index')->with('success', 'lecture deleted successfully!');
    }

    public function download(Lecture $lecture)
    {
        // Get the file path from the lecture
        $filePath = storage_path('app/public/' . $lecture->file_path);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Return the file as a download response
            return response()->download($filePath);
        }

        return redirect()->route('lectures.index')->with('error', 'File not found!');
    }
}
