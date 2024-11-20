<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Semester $semesters)
    {
        $subjects = Subject::all(); // Fetch all subjects
        $semesters = Semester::all(); // Fetch all semesters
        return view('subjects.index', compact('subjects', 'semesters'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //creating a new subject
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'semester' => 'required|integer|between:1,7',
        ]);

        Subject::create([
            'Subject_name' => $request->name,
            'semester_id' => $request->semester,
        ]);

        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        // show all subjects and their related lectures
        $subject = Subject::with('lectures')->findOrFail($subject->id);;
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject, Semester $semesters)
    {
        $semesters = Semester::all(); // Fetch all semesters
        return view('subjects.edit', compact('subject', 'semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|between:1,7', // Assuming you have a number field
        ]);

        // Update the subject
        $subject->update([
            'Subject_name' => $request->name,
            'semester_id' => $request->number,
        ]);

        // Redirect with success message
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        foreach($subject->lectures as $lecture){
            Storage::disk('public')->delete($lecture->file_path);
        }
        $subject->delete();
        return redirect()->route('subjects.index')->with('success','subject deleted successfully!');
    }
}