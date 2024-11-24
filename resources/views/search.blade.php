@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">  <!-- This will make the content narrower -->
            <h1>Search Results for: {{ $search }}</h1>

            <h2>Lectures: </h2>
            @if (!$lectures || $lectures->count() == 0)
               <p>no lectures found.</p>
            @else
               @foreach ($lectures as $lecture)
                  <div class="card mb-4">
                     <div class="card-header">{{ $lecture->title }}</div>
                     <div class="card-body">
                        <a href="{{ asset('storage/' . $lecture->file_path) }}" target="_blank"
                           class="btn btn-sm btn-outline-primary">
                           <i class="fas fa-file-pdf"></i> View PDF
                        </a>
                     </div>
                  </div>
               @endforeach
            @endif

            <h2>Subjects:</h2>
            @if (!$subjects || $subjects->count() == 0)
               <p>No subjects found.</p>
            @else
               @foreach ($subjects as $subject)
                  <div class="card mb-4">
                     <div class="card-header">{{ $subject->Subject_name }}</div>
                     <div class="card-body">
                        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-outline-primary">
                           <i class="fas fa-eye"></i> 
                           View Subject
                        </a>
                     </div>
                  </div>
               @endforeach
            @endif
            
            <h2>exam papers: </h2>
            @if (!$exam_papers || $exam_papers->count() == 0)
               <p>no exam_papers found.</p>
            @else
               @foreach ($exam_papers as $exam_paper)
                  <div class="card mb-4">
                     <div class="card-header">{{ $exam_paper->title }}</div>
                     <div class="card-body">
                        <a href="{{ asset('storage/' . $exam_paper->file_path) }}" target="_blank"
                           class="btn btn-sm btn-outline-primary">
                           <i class="fas fa-file-pdf"></i> View PDF
                        </a>
                     </div>
                  </div>
               @endforeach
            @endif
         </div>
      </div>
   </div>
@endsection
