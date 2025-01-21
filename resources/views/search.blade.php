@extends('layouts.app')

@section('content')
<div class="container py-5">
   <div class="row justify-content-center">
       <div class="col-md-10">  
           <h1 class="text-center mb-5">
               <i class="fas fa-search me-2"></i>Search Results for: <strong>{{ $search }}</strong>
           </h1>

           <!-- Lectures Section -->
           <section class="mb-5">
               <h2 class="text-primary">
                   <i class="fas fa-book-open me-2"></i>Lectures
               </h2>
               @if (!$lectures || $lectures->count() == 0)
                   <p class="text-muted">No lectures found.</p>
               @else
                   <div class="row row-cols-1 row-cols-md-2 g-4">
                       @foreach ($lectures as $lecture)
                           <div class="col">
                               <div class="card shadow-sm h-100">
                                   <div class="card-header bg-primary text-white fw-bold">
                                       {{ $lecture->title }}
                                   </div>
                                   <div class="card-body text-center">
                                       <a href="{{ Storage::disk('r2')->url($lecture->file_path); }}" target="_blank"
                                          class="btn btn-outline-primary w-75">
                                           <i class="fas fa-file-pdf me-1"></i> View PDF
                                       </a>
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   </div>
               @endif
           </section>

           <!-- Subjects Section -->
           <section class="mb-5">
               <h2 class="text-success">
                   <i class="fas fa-book-reader me-2"></i>Subjects
               </h2>
               @if (!$subjects || $subjects->count() == 0)
                   <p class="text-muted">No subjects found.</p>
               @else
                   <div class="row row-cols-1 row-cols-md-2 g-4">
                       @foreach ($subjects as $subject)
                           <div class="col">
                               <div class="card shadow-sm h-100">
                                   <div class="card-header bg-success text-white fw-bold">
                                       {{ $subject->Subject_name }}
                                   </div>
                                   <div class="card-body text-center">
                                       <a href="{{ route('subjects.show', $subject->id) }}" 
                                          class="btn btn-outline-success w-75">
                                           <i class="fas fa-eye me-1"></i> View Subject
                                       </a>
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   </div>
               @endif
           </section>

           <!-- Exam Papers Section -->
           <section class="mb-5">
               <h2 class="text-danger">
                   <i class="fas fa-file-alt me-2"></i>Exam Papers
               </h2>
               @if (!$exam_papers || $exam_papers->count() == 0)
                   <p class="text-muted">No exam papers found.</p>
               @else
                   <div class="row row-cols-1 row-cols-md-2 g-4">
                       @foreach ($exam_papers as $exam_paper)
                           <div class="col">
                               <div class="card shadow-sm h-100">
                                   <div class="card-header bg-danger text-white fw-bold">
                                       {{ $exam_paper->title }}
                                   </div>
                                   <div class="card-body text-center">
                                       <a href="{{ Storage::disk('r2')->url($exam_paper->file_path); }}" target="_blank"
                                          class="btn btn-outline-danger w-75">
                                           <i class="fas fa-file-pdf me-1"></i> View PDF
                                       </a>
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   </div>
               @endif
           </section>
       </div>
   </div>
</div>
@endsection
