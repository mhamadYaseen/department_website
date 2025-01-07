@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Modern Header with Gradient -->
            <div class="card-header d-flex justify-content-around align-items-center" style="background-color: #feebd5;">
                <h5 class="mb-0">Subject: {{ $subject->Subject_name }}</h5>
                <h5 class="mb-0">lecturer: {{ $subject->Subject_lecturer }}</h5>
            </div>

            <!-- Content Section with Modern Styling -->
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-12">
                        @include('shared.lectures-card')
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Back Button -->
        <div class="text-center mt-5">
            <a href="{{ route('subjects.index') }}" class="btn btn-lg px-4 py-2 rounded-pill shadow-sm"
                style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); color: white;">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Subjects
            </a>
        </div>
        @include('shared.lecture-info-modal')
    </div>
@endsection
