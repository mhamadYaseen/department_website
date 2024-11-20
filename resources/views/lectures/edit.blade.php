@extends('layouts.app')

@section('content')
<div class="container">
   @if ($errors->any())
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif
   <div class="row justify-content-center">

      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Edit Lecture</div>
            <div class="card-body">
               <form method="POST" action="{{ route('lectures.update', $lecture->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-group mb-3">
                     <label for="title">Lecture Title</label>
                     <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $lecture->title) }}" 
                           required>
                     @error('title')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="subject_id">Subject</label>
                     <select class="form-control @error('subject_id') is-invalid @enderror" 
                           id="subject_id" 
                           name="subject_id" 
                           required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                           <option value="{{ $subject->id }}" 
                                 {{ old('subject_id', $lecture->subject_id) == $subject->id ? 'selected' : '' }}>
                              {{ $subject->Subject_name}}
                           </option>
                        @endforeach
                     </select>
                     @error('subject_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="lecturer">Lecturer Name</label>
                     <input type="text" 
                           class="form-control @error('lecturer') is-invalid @enderror" 
                           id="lecturer" 
                           name="lecturer" 
                           value="{{ old('lecturer', $lecture->lecturer) }}">
                     @error('lecturer')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="pdf_file">PDF File (Optional)</label>
                     @if($lecture->file_path)
                        <p>Current file: {{ basename($lecture->file_path) }}</p>
                     @endif
                     <input type="file" 
                           class="form-control @error('pdf_file') is-invalid @enderror" 
                           id="pdf_file" 
                           name="pdf_file" 
                           accept=".pdf">
                     @error('pdf_file')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <button type="submit" class="btn btn-primary">Update Lecture</button>
                     <a href="{{ route('lectures.index') }}" class="btn btn-secondary">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection