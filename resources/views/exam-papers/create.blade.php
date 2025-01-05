@php
   $subjects = \App\Models\Subject::all();
@endphp
@extends('layouts.app')


@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Create New Exam Paper</div>

            <div class="card-body">
               <form method="POST" action="{{ route('exam-papers.store') }}" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group mb-3">
                     <label for="title">Title</label>
                     <input type="text" class="form-control @error('title') is-invalid @enderror" 
                        id="title" name="title" value="{{ old('title') }}" required>
                     @error('title')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group mb-3">
                     <label for="description">description</label>
                     <input type="text" class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" value="{{ old('description') }}" >
                     @error('description')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="subject_id">Subject</label>
                     <select class="form-control @error('subject_id') is-invalid @enderror" 
                        id="subject_id" name="subject_id" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                           <option value="{{ $subject->id }}">{{ $subject->Subject_name }}</option>
                        @endforeach
                     </select>
                     @error('subject_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="pdf_file">PDF File</label>
                     <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" 
                        id="pdf_file" name="pdf_file" accept=".pdf" required>
                     @error('pdf_file')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <button type="submit" class="btn btn-primary">Upload Exam Paper</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection