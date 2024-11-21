@extends('layouts.app')

@section('content')
<div class="container">
   <h1 class="mb-4">All Semesters</h1>

   @foreach($semesters as $semester)
      <div class="card mb-4">
         <div class="card-header">
            <h3>Semester {{ $semester->semester_number }}</h3>
         </div>
         <div class="card-body">
            @if($semester->subjects->count() > 0)
               @foreach($semester->subjects as $subject)
                  <div class="mb-3">
                     <h4 class="text-primary">{{ $subject->Subject_name }}</h4>
                     
                     @if($subject->lectures->count() > 0)
                        <ul class="list-group">
                           @foreach($subject->lectures as $lecture)
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 {{ $lecture->title }}
                                 <a href="{{ asset('storage/' . $lecture->file_path) }}" 
                                    class="btn btn-sm btn-primary" 
                                    target="_blank">
                                    View PDF
                                 </a>
                              </li>
                           @endforeach
                        </ul>
                     @else
                        <p class="text-muted">No lectures available for this subject.</p>
                     @endif
                  </div>
               @endforeach
            @else
               <p class="text-muted">No subjects available for this semester.</p>
            @endif
         </div>
      </div>
   @endforeach
</div>
@endsection