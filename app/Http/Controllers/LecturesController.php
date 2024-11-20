<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LecturesController extends Controller
{
    public function index()
{
    // Fetch all lectures with their related subjects
    $lectures = Lecture::with('subject')->get(); 
    return view('lectures.index', compact('lectures'));
}


    public function create(Subject $subjects)
    {
        $subjects = Subject::all(); // Fetch all subjects from the database
        return view('lectures.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required|exists:subjects,id', // Validate that subject_id exists in the subjects table
            'lecturer' => 'required',
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Store the uploaded PDF in the 'public/files' directory and get the path
        $filePath = $request->file('pdf')->store('files', 'public');

        // Store the lecture in the database with the subject_id
        Lecture::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id, // Use subject_id from the request
            'lecturer' => $request->lecturer,
            'file_path' => $filePath
        ]);

        return redirect()->route('lectures.index');
    }


    public function show(Lecture $lecture)
    {
        return view('lectures.index', compact('lecture'));
    }

    public function edit(Lecture $lecture)
    {
        return view('lectures.index', compact('lecture'));
    }

    public function update(Request $request, Lecture $lecture)
    {
        // Validate input data
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required|exists:subjects,id', // Validate subject_id
            'lecturer' => 'required',
            'pdf' => 'nullable|mimes:pdf|max:2048', // Allow pdf to be nullable (optional update)
        ]);

        // Check if a new file is uploaded
        if ($request->hasFile('pdf')) {
            // Delete the old file if it exists
            if ($lecture->file_path) {
                Storage::disk('public')->delete($lecture->file_path);
            }

            // Store the new uploaded PDF and get the file path
            $filePath = $request->file('pdf')->store('files', 'public');
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

        return redirect()->route('lectures.index')->with('success','lecture updated successfully!');
    }

    public function destroy(Lecture $lecture)
    {
        // Delete the file from storage
        if ($lecture->file_path) {
            Storage::disk('public')->delete($lecture->file_path);
        }

        // Delete the lecture from the database
        $lecture->delete();

        return redirect()->route('lectures.index')->with('success','lecture deleted successfully!');
    }
}
