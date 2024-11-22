@extends('layouts.app')

@section('content')
<div class="container">
   @include('layouts.message')
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
                     <h4 class="text-primary text-center">{{ $subject->Subject_name }}</h4>
                     <ul class="text-center">
                        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>
                     </ul>
                     @include('shared.lectures-card')
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