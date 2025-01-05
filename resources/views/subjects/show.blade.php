@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-0">{{ $subject->Subject_name }}</h2>
                    <p class="text-light mb-0">Semester: {{ $subject->semester_id }}</p>
                </div>
                <div>
                    <i class="fas fa-book fa-2x"></i>
                </div>
            </div>
            <div class="card-body">
                @include('shared.lectures-card')
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('subjects.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-left me-2"></i> Back to Subjects
            </a>
        </div>
    </div>
@endsection
