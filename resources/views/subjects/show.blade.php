@extends('layouts.app')

@section('content')
<div class="container">
   <div class="card mb-4">
      <div class="card-header">
         <h2>{{ $subject->Subject_name }}</h2>
         <p class="text-muted">Semester: {{ $subject->semester_id }}</p>
      </div>
      <div class="card-body">
         <h3>Lectures</h3>
         @if($subject->lectures->count() > 0)
            <div class="list-group">
               @foreach($subject->lectures as $lecture)
                  <div class="list-group-item">
                     <h5 class="mb-1">{{ $lecture->title }}</h5>
                     <p class="mb-1">{{ $lecture->lecturer}}</p>
                  </div>
               @endforeach
            </div>
         @else
            <p>No lectures available for this subject.</p>
         @endif
      </div>
   </div>
   <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subjects</a>
</div>
@endsection