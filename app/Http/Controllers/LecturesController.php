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
                'description' => 'nullable|string|',
                'pdf_file' => 'required|mimes:pdf|max:10240',
            ]);
            if (!$request->description) {
                $request->merge(['description' => 'there is no description']);
            }
            // Store the uploaded PDF in the 'public/files' directory and get the path
            $filePath = $request->file('pdf_file')->store('files', 'r2');


            // Store the lecture in the database with the subject_id
            $lecture = Lecture::create([
                'title' => $request->title,
                'subject_id' => $request->subject_id, // Use subject_id from the request
                'description' => $request->description,
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
            'description' => 'nullable|string',
            'pdf_file' => 'nullable|mimes:pdf|max:10240', // 10MB limit (10240KB)
        ]);

        // Set a default description if none is provided
        if (!$request->description) {
            $request->merge(['description' => 'there is no description']);
        }

        // Handle file update if a new file is uploaded
        if ($request->hasFile('pdf_file')) {
            // Delete the old file from R2 if it exists
            if ($lecture->file_path) {
                Storage::disk('r2')->delete($lecture->file_path);
            }

            // Store the new file in the R2 disk and get the file path
            $filePath = $request->file('pdf_file')->store('files', 'r2');
        } else {
            // Keep the old file path if no new file is uploaded
            $filePath = $lecture->file_path;
        }

        // Update the lecture in the database
        $lecture->update([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
            'file_path' => $filePath, // Save the file path (new or existing)
        ]);

        return redirect()->route('lectures.index')->with('success', 'Lecture updated successfully!');
    }


    public function destroy($id)
    {
        $lecture = Lecture::findOrFail($id); // Fetch the lecture from the database

        // Check if the file exists in the R2 storage
        if (Storage::disk('r2')->exists($lecture->file_path)) {
            // Delete the file from R2
            Storage::disk('r2')->delete($lecture->file_path);
        }

        // Delete the lecture record from the database
        $lecture->delete();

        // Redirect with success message
        return redirect()->back()->with('success', 'File and lecture record deleted successfully!');
    }


    public function forceDownload(Lecture $lecture)
    {
        // Check if the file exists in Cloudflare R2
        if (Storage::disk('r2')->exists($lecture->file_path)) {
            // Fetch the file content from R2
            $fileContent = Storage::disk('r2')->get($lecture->file_path);

            // Create the download response with appropriate headers
            return response($fileContent, 200, [
                'Content-Type' => Storage::disk('r2')->mimeType($lecture->file_path),
                'Content-Disposition' => 'attachment; filename="' . basename($lecture->file_path) . '"',
            ]);
        }

        // Redirect back if the file does not exist
        return redirect()->back()->with('error', 'File not found.');
    }
}
