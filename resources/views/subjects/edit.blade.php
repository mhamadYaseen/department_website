@extends('layouts.app')

@section('content')
<div class="container mt-5 py-5">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Edit Subject</div>

            <div class="card-body">
               <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
                  @csrf
                  @method('PUT')

                  <div class="form-group mb-3">
                     <label for="name">Subject Name</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" value="{{ old('name', $subject->Subject_name) }}" required>
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="lecturer">Subject lecturer</label>
                     <input type="text" class="form-control @error('lecturer') is-invalid @enderror" 
                        id="lecturer" name="lecturer" value="{{ old('lecturer', $subject->Subject_lecturer) }}" required>
                     @error('lecturer')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="semester_id">Semester</label>
                     <select class="form-control @error('semester_id') is-invalid @enderror" 
                        id="semester_id" name="semester_id" required>
                        <option value="">Select Semester</option>
                        @foreach($semesters as $semester)
                           <option value="{{ $semester->id }}" 
                              {{ old('semester_id', $subject->semester_id) == $semester->id ? 'selected' : '' }}>
                              semester: {{ $semester->semester_number }}
                           </option>
                        @endforeach
                     </select>
                     @error('semester_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <button type="submit" class="btn btn-primary">Update Subject</button>
                     <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection