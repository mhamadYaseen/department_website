@extends('layouts.app')

@section('content')
    <div class="container mt-5 py-2">
        @auth
            @if (Auth::user()->hasRole('Admin'))
                <div class="row border-bottom border-primary p-3">
                    <div class="col-sm-2">
                        <h4 class="text-primary font-weight-bold ">Admin Access</h4>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{ route('exam-papers.create') }}" class="btn text"
                            style="background-color: #ff9100; border-bottom: 2px solid #e68400;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Add
                            New exam paper</a>
                    </div>
                </div>
            @endif
        @endauth
        <h1 class=" text-center" style="font-weight: bold;">Exam Papers by Subject</h1>
        <div class="accordion " id="semesterAccordion">
            @foreach ($semesters as $semester)
                <div class="accordion-item border-0">
                    <h2 class="accordion-header text-black mb-1" id="headingSemester{{ $semester->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSemester{{ $semester->id }}" aria-expanded="false"
                            aria-controls="collapseSemester{{ $semester->id }}">
                            Semester {{ $semester->semester_number }}
                        </button>
                    </h2>
                    <div id="collapseSemester{{ $semester->id }}" class="accordion-collapse collapse shadow-lg"
                        aria-labelledby="headingSemester{{ $semester->id }}" data-bs-parent="#semesterAccordion">
                        <div class="accordion-body">
                            @if ($semester->subjects->count() > 0)
                                @foreach ($semester->subjects as $subject)
                                    <div class="card shadow-sm mb-3">
                                        <div class="card-header d-flex justify-content-around align-items-center"
                                            style="background-color: #feebd5;">
                                            <h5 class="mb-0">Subject: {{ $subject->Subject_name }}</h5>
                                            <h5 class="mb-0">lecturer: {{ $subject->Subject_lecturer }}</h5>
                                        </div>
                                        <div class="card-body ">
                                           @include('shared.exam-papers-card')
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class=" text-muted p-3">
                                    <i class="fas fa-info-circle"></i> No subjects with exam papers found.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal (placed outside the loop to avoid duplication) -->
                @include('shared.exam-paper-info-modal')
            @endforeach
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .card-header {
            background-color: #0d6efd !important;
        }

        .btn-group {
            gap: 0.5rem;
        }
    </style>
@endsection
