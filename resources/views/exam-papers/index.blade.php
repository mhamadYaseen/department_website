@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
        @if (Auth::user()->hasRole('Admin'))
        <div class="row border-bottom border-primary p-3">
            <div class="col-sm-2">
                <h4 class="text-primary font-weight-bold ">Admin Access</h4>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('exam-papers.create') }}" class="btn text"
                    style="background-color: #ff9100; border-bottom: 2px solid #e68400;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Add New exam paper</a>
            </div>
        </div>
    @endif
        @endauth
        <h1 class="mb-4 text-center" style="font-weight: bold;">Exam Papers by Subject</h1>
        @foreach ($semesters as $semester)
            <div class="accordion" id="accordionExample">
                <div class="accordion-item mb-1">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSemester{{ $semester->id }}" aria-expanded="false"
                            aria-controls="collapseSemester{{ $semester->id }}">
                            Semester {{ $semester->semester_number }}
                        </button>
                    </h2>
                    <div id="collapseSemester{{ $semester->id }}" class="collapse according-collapse"
                        aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if ($semester->subjects->count() > 0)
                                @foreach ($semester->subjects as $subject)
                                    <div class="card shadow-sm mb-3">
                                        <div class="card-header d-flex justify-content-around align-items-center" style="background-color: #feebd5;">
                                            <h5 class="mb-0">Subject:  {{ $subject->Subject_name }}</h5>
                                            <h5 class="mb-0">lecturer: {{ $subject->Subject_lecturer }}</h5>
                                        </div>
                                        <div class="card-body ">
                                            @if ($subject->examPapers->count() > 0)
                                                <div class="list-group">
                                                    <div class="w-100 mx-auto my-3 opacity-5"
                                                        style="height: 3px;
                                                        background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
                                                    </div>
                                                    @foreach ($subject->examPapers as $paper)
                                                        <div
                                                            class="list-group-item 
                                                            list-group-item-action d-flex 
                                                            flex-column flex-md-row 
                                                            justify-content-between 
                                                            align-items-md-center
                                                            border-0">
                                                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                                                <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                                                <div>
                                                                    <h5 class="mb-0">{{ $paper->title }}</h5>
                                                                    <small
                                                                        class="text-muted d-none d-lg-inline">{{ $paper->created_at->format('F j, Y') }}</small>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex flex-wrap justify-content-start justify-content-md-end align-items-center">
                                                                <a href="{{ asset('storage/' . $paper->file_path) }}"
                                                                    target="_blank"
                                                                    class="btn btn-sm btn-primary me-2 d-flex align-items-center">
                                                                    <i class="fas fa-file-pdf me-1"></i> View
                                                                </a>
                                                                <a href="{{ route('exam-papers.download', $paper->id) }}"
                                                                    class="btn btn-sm btn-success me-2 d-flex align-items-center">
                                                                    <i class="fas fa-download me-1"></i> Download
                                                                </a>
                                                                <a href="{{ route('exam-papers.edit', $paper->id) }}"
                                                                    class="btn btn-sm btn-secondary me-2 d-flex align-items-center">
                                                                    <i class="fas fa-edit me-1"></i> Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('exam-papers.destroy', $paper->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger d-flex align-items-center me-2"
                                                                        onclick="return confirm('Are you sure you want to delete this exam paper?')">
                                                                        <i class="fas fa-trash me-1"></i> Delete
                                                                    </button>
                                                                </form>
                                                                <a type="button"
                                                                    class="btn btn-sm btn-warning d-flex align-items-center text-white"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#examPaperInfoModal"
                                                                    data-description="{{ $paper->description }}"
                                                                    data-title="{{ $paper->title }}">
                                                                    <i class="fa-solid fa-circle-info me-1"></i> Description
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="w-100 mx-auto my-3 opacity-5"
                                                            style="height: 3px;
                                                    background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-muted">No exam papers available for this subject.</p>
                                            @endif
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
            </div>

            <!-- Modal (placed outside the loop to avoid duplication) -->
            @include('shared.exam-paper-info-modal')
        @endforeach
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
