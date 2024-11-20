@extends('layouts.app')

@section('content')
<div class="container">
   <h1 class="text-center mb-4">All Subjects and all Semester</h1>

   @foreach($semesters as $semester)
      <div class="card mb-4">
         <div class="card-header bg-primary text-white">
            <h3>Semester {{ $semester->semester_number }}</h3>
         </div>
         <div class="card-body">
            @if($semester->subjects->count() > 0)
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>Subject Name</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($semester->subjects as $subject)
                           <tr>
                              <td>{{ $subject->Subject_name }}</td>
                              
                              <td>
                                 <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-info">View</a>
                                 <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <p class="text-center">No subjects found for this semester.</p>
            @endif
         </div>
      </div>
   @endforeach
</div>
@endsection