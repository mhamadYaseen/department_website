@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Lecture</h2>
        <form action="{{ route('lectures.store') }}" method="POST" enctype="multipart/form-data"> <!-- Added enctype attribute -->
         @csrf
         <div class="form-group">
             <label for="title">Lecture Title</label>
             <input type="text" class="form-control" id="title" name="title" required>
         </div>
     
         <div class="form-group">
             <label for="lecturer">Lecturer</label>
             <input type="text" class="form-control" id="lecturer" name="lecturer" required>
         </div>
     
         <div class="form-group">
             <label for="subject">Subject</label>
             <!-- Changed name="subject" to name="subject_id" -->
             <select class="form-control" id="subject" name="subject_id" required>
                 @foreach ($subjects as $subject)
                     <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                 @endforeach
             </select>
         </div>
     
         <div class="form-group">
             <label for="pdf">Upload PDF</label>
             <!-- Added enctype="multipart/form-data" in form tag to handle file uploads -->
             <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
         </div>
     
         <button type="submit" class="btn btn-primary">Create Lecture</button>
     </form>
     
    </div>
@endsection
