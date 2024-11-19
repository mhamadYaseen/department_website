<?php

namespace App\Http\Controllers;

use App\Models\lectures;
use Illuminate\Http\Request;

class LecturesController extends Controller
{
    public function index()
    {
        $lectures = lectures::all(); // Fetch all lectures from the database
        return view('lectures.index', compact('lectures'));
    }
}
