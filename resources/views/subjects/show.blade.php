@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <h2>{{ $subject->Subject_name }}</h2>
                <p class="text-muted">Semester: {{ $subject->semester_id }}</p>
            </div>
           @include('shared.lectures-card')
        </div>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to Subjects</a>
    </div>
@endsection
