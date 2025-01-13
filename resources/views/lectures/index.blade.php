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
                        <a href="{{ route('lectures.create') }}" class="btn text"
                            style="background-color: #ff9100; border-bottom: 2px solid #e68400;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Add
                            New lecture</a>
                    </div>
                </div>
            @endif
        @endauth
        <h1 class="text-center" style="font-weight: bold;">All lectures</h1>
        <div class="container">
            <div class="accordion" id="semesterAccordion">
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
                                    <div class="row">
                                        <div class="accordion" id="subjectAccordion{{ $semester->id }}">
                                            @foreach ($semester->subjects as $subject)
                                                <div class="accordion-item border-0 mb-3">
                                                    <h2 class="accordion-header" id="heading{{ $subject->id }}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                            data-bs-target="#collapse{{ $subject->id }}" aria-expanded="false"
                                                            aria-controls="collapse{{ $subject->id }}">
                                                            {{ $subject->Subject_name }} - {{ $subject->Subject_lecturer }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{ $subject->id }}" class="accordion-collapse collapse"
                                                        aria-labelledby="heading{{ $subject->id }}" data-bs-parent="#subjectAccordion{{ $semester->id }}">
                                                        <div class="accordion-body">
                                                            @include('shared.lectures-card')
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted">No subjects available for this semester.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @include('shared.lecture-info-modal')
                @endforeach
            </div>
        </div>

    </div>


@endsection
