@extends('layouts.app')

@section('content')
<div class="container mt-5">
   <h1>Edit Exam Paper</h1>
   <form action="{{ route('exam-papers.update', $examPaper->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
         <label for="title">Title</label>
         <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $examPaper->title) }}" required>
      </div>

      <div class="form-group">
         <label for="subject_id">Subject</label>

         <select name="subject_id" id="subject_id" class="form-control" required>
            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
               <option value="{{ $subject->id }}" {{ $subject->id == old('subject_id', $examPaper->subject_id) ? 'selected' : '' }}>
                  {{$subject->Subject_name}}
               </option>
            @endforeach
         </select>
      </div>
      <div class="form-group mb-3">
         <label for="description">Description</label>
         <input type="text" class="form-control @error('description') is-invalid @enderror" 
            id="description" name="description" value="{{ old('description', $examPaper->description) }}" >
         @error('description')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
         @enderror
      </div>


      <div class="form-group">
         <label for="pdf_file">PDF File</label>
         <input type="file" name="pdf_file" id="pdf_file" class="form-control">
         <small>Current file: {{ $examPaper->pdf_file }}</small>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
   </form>
</div>
@endsection