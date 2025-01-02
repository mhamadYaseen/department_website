@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Exam Papers by Subject</h1>

        @forelse ($subjects as $subject)
            <div class="card mb-4">
                <div class="card-header text-white">
                    <h4 class="mb-0">{{ $subject->Subject_name }}</h4>
                </div>
                <div class="card-body">
                    @if ($subject->examPapers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>download</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subject->examPapers as $paper)
                                        <tr>
                                            <td class="text-truncate text-center" style="max-width: 200px;">
                                                <a href="{{ asset('storage/' . $paper->file_path) }}" target="_blank"
                                                    class="text-decoration-none">
                                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                                    {{ $paper->title }}
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('exam-papers.download', $paper->id) }}"
                                                    class="btn btn-sm btn-outline-success ">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                
                                                <div class="btn-group" role="group">
                                                    <a href="{{ asset('storage/' . $paper->file_path) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary rounded">
                                                        <i class="fas fa-file-pdf"></i> View
                                                    </a>
    
                                                    <a href="{{ route('exam-papers.edit', $paper->id) }}"
                                                        class="btn btn-sm btn-outline-primary ms-1 rounded">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('exam-papers.destroy', $paper->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-1 rounded"
                                                            onclick="return confirm('Are you sure you want to delete this exam paper?')">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No exam papers available for this subject.</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No subjects with exam papers found.
            </div>
        @endforelse
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
