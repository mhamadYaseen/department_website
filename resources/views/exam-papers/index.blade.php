@extends('layouts.app')

@section('content')
   <div class="container py-4">
      <h1 class="h2 mb-4">Exam Papers Repository</h1>

      @forelse($examPapers->groupBy('subject_id') as $courseName => $papers)
         <div class="card mb-4">
            <div class="card-body">
               <h2 class="h4 mb-3 pb-2 border-bottom">
                  {{ $courseName }}
               </h2>

               <div class="row g-4">
                  @foreach ($papers as $paper)
                     <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                           <div class="card-body">
                              <h3 class="h6">{{ $paper->lecturer->name }}</h3>
                              <div class="d-flex justify-content-between align-items-center mt-3">
                                 <span class="small text-muted">
                                    {{ $paper->created_at->format('M d, Y') }}
                                 </span>
                                 <a href="{{ route('exam-papers.show', $paper) }}"
                                    class="btn btn-link p-0">
                                    View Paper →
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      @empty
         <div class="text-center py-4">
            <p class="text-muted">No exam papers have been uploaded yet.</p>
         </div>
      @endforelse
   </div>
@endsection