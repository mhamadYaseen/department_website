@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <!-- Modern Header with Gradient -->
        <div class="card-header bg-gradient position-relative py-4" 
             style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
            <div class="d-flex justify-content-between align-items-center px-4">
                <div>
                    <h2 class="display-6  mb-1 fw-bold">{{ $subject->Subject_name }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-white text-primary rounded-pill px-3 py-2">
                            Semester {{ $subject->semester_id }}
                        </span>
                    </div>
                </div>
                <div class="subject-icon">
                    <i class="fas fa-book-open fa-3x text-white opacity-75"></i>
                </div>
            </div>
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
        <a href="{{ route('subjects.index') }}" 
           class="btn btn-lg px-4 py-2 rounded-pill shadow-sm"
           style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); color: white;">
            <i class="fas fa-arrow-left me-2"></i>
            Back to Subjects
        </a>
    </div>
</div>

<!-- Add custom styles -->
<style>
    .card {
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .subject-icon {
        transition: transform 0.3s ease;
    }
    .subject-icon:hover {
        transform: scale(1.1);
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
