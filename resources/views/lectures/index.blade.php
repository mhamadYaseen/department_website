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
                        <a href="{{ route('lectures.create') }}" class="btn text"
                            style="background-color: #ff9100; border-bottom: 2px solid #e68400;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Add
                            New lecture</a>
                    </div>
                </div>
            @endif
        @endauth
        <h1 class="text-center mb-4" style="font-weight: bold;">All lectures</h1>
        <div class="container mt-5">
            <div class="accordion" id="semesterAccordion">
                @foreach ($semesters as $semester)
                    <div class="accordion-item">
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
                                        @foreach ($semester->subjects as $subject)
                                            <div class=" mb-4 ">
                                                <div class="card shadow-sm ">
                                                    <div class="card-header " style="background-color: #feebd5;">
                                                        <h5 class="mb-0">{{ $subject->Subject_name }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        @if ($subject->lectures->count() > 0)
                                                            <ul class="list-group list-group-flush">
                                                                <div class="w-100 mx-auto my-3 opacity-5"
                                                                    style="height: 3px;
                                                                        background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
                                                                </div>
                                                                @foreach ($subject->lectures as $lecture)
                                                                    <li
                                                                        class="list-group-item 
                                                                                list-group-item-action d-flex 
                                                                                flex-column flex-md-row 
                                                                                justify-content-between 
                                                                                align-items-md-center
                                                                                border-0">

                                                                        <div class="d-flex align-items-center mb-2 mb-md-0">
                                                                            <i
                                                                                class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                                                            <div>
                                                                                <h5 class="mb-0">{{ $lecture->title }}
                                                                                </h5>
                                                                                <small
                                                                                    class="text-muted d-none d-lg-inline">{{ $lecture->created_at->format('F j, Y') }}</small>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="d-flex flex-wrap row g-2 g-md-2 align-items-center">
                                                                            @auth
                                                                                @if ($lecture->file_path)
                                                                                    <div class="col-6 col-md-auto">
                                                                                        <a href="{{ asset('storage/' . $lecture->file_path) }}"
                                                                                            target="_blank"
                                                                                            class="btn btn-sm btn-primary d-flex align-items-center w-100">
                                                                                            <i class="fas fa-file-pdf me-1"></i>
                                                                                            View
                                                                                        </a>
                                                                                    </div>
                                                                                    @can('download files', $lecture)
                                                                                        <div class="col-6 col-md-auto">
                                                                                            <a href="{{ asset('storage/' . $lecture->file_path) }}"
                                                                                                download
                                                                                                class="btn btn-sm btn-info d-flex align-items-center w-100">
                                                                                                <i class="fas fa-download me-1"></i>
                                                                                                Download
                                                                                            </a>
                                                                                        </div>
                                                                                    @endcan
                                                                                @endif
                                                                            @endauth

                                                                            @can('edit files', $lecture)
                                                                                <div class="col-6 col-md-auto">
                                                                                    <a href="{{ route('lectures.edit', $lecture->id) }}"
                                                                                        class="btn btn-sm btn-secondary d-flex align-items-center w-100">
                                                                                        <i class="fas fa-edit me-1"></i> Edit
                                                                                    </a>
                                                                                </div>
                                                                            @endcan

                                                                            @can('delete files', $lecture)
                                                                                <div class="col-6 col-md-auto">
                                                                                    <form
                                                                                        action="{{ route('lectures.destroy', $lecture->id) }}"
                                                                                        method="POST" class="d-inline w-100">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="btn btn-sm btn-danger d-flex align-items-center w-100">
                                                                                            <i class="fas fa-trash me-1"></i>
                                                                                            Delete
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            @endcan

                                                                            <!-- Info Icon Button -->
                                                                            <div class="col-6 col-md-auto">
                                                                                <a type="button"
                                                                                    class="btn btn-sm btn-warning d-flex align-items-center w-100 text-white"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#lectureInfoModal"
                                                                                    data-description="{{ $lecture->description }}"
                                                                                    data-title="{{ $lecture->title }}">
                                                                                    <i
                                                                                        class="fa-solid fa-circle-info fa-lg me-1"></i>
                                                                                    Description
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    {{-- Lecture Info Modal --}}
                                                                    @include('shared.lecture-info-modal')

                                                                    <div class="w-100 mx-auto my-3 opacity-5"
                                                                        style="height: 3px;
                                                                            background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="text-muted">No lectures available.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No subjects available for this semester.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
