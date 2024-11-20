@extends('layouts.app')

@section('content')
<div class="container">
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
                     <label for="semester_id">Semester</label>
                     <select class="form-control @error('semester_id') is-invalid @enderror" 
                        id="semester_id" name="semester_id" required>
                        @foreach($semesters as $semester)
                           <option value="{{ $semester->id }}" 
                              {{ old('Semester_id', $subject->Semester_id) == $semester->id ? 'selected' : '' }}>
                              {{ $semester->semester_number }}
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