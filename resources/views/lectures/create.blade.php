@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Lecture</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @can('upload files')
        <form action="{{ route('lectures.store') }}" method="POST" enctype="multipart/form-data">
            <!-- Added enctype attribute -->
            @csrf
            <div class="form-group">
                <label for="title">Lecture Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" 
                   id="description" name="description" value="{{ old('description') }}" >
                @error('description')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                   </span>
                @enderror
             </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <!-- Changed name="subject" to name="subject_id" -->
                <select class="form-control" id="subject_id" name="subject_id" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->Subject_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pdf_file">Upload PDF</label>
                <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept="application/pdf" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Create Lecture</button>
        </form>
        @endcan

    </div>
@endsection
