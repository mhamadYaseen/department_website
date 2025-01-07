@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- Statistics Section -->
        <div class="row justify-content-center">
            <div class="col-md-3 mx-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Total Users</h5>
                        <p>{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mx-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Total Subjects</h5>
                        <p>{{ $totalSubjects }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mx-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Total Exam papers</h5>
                        <p>{{ $totalExams }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management -->
        <h2 class="text-center mt-4">Manage Users</h2>
        <div class="table-responsive">
            <table class="table table-bordered mx-auto" style="max-width: 800px;">
                <thead>
                    <tr>
                        <th class="px-4">Name</th>
                        <th class="px-4">Email</th>
                        <th class="px-4">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4">{{ $user->name }}</td>
                            <td class="px-4">{{ $user->email }}</td>
                            <td class="px-4">{{ $user->roles->pluck('name')->join(', ') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">Assign Roles</h5>
                        <form action="{{ route('admin.assignRole') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user">Select User</label>
                                <select name="user_id" id="user" class="form-control">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}: ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-2">Assign Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add this after your existing users table card -->

        <div class="row mt-4">
            <!-- Create Subject Card -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-book fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Manage Subjects</h5>
                        <p class="card-text">Create and manage academic subjects</p>
                        <a href="{{ route('subjects.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create New Subject
                        </a>
                        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-list"></i> View All Subjects
                        </a>
                    </div>
                </div>
            </div>

            <!-- Create Lecture Card -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-pdf fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title">Manage Lectures</h5>
                        <p class="card-text">Upload and manage lecture materials</p>
                        <a href="{{ route('lectures.create') }}" class="btn btn-danger">
                            <i class="fas fa-plus"></i> Upload New Lecture
                        </a>
                        <a href="{{ route('lectures.index') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-list"></i> View All Lectures
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- create Exampaper card --}}
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-pdf fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title">Manage Exam Papers</h5>
                        <p class="card-text">Upload and manage exam papers</p>
                        <a href="{{ route('exam-papers.create') }}" class="btn btn-danger">
                            <i class="fas fa-plus"></i> Upload New Exam Paper
                        </a>
                        <a href="{{ route('exam-papers.index') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-list"></i> View All Exam Papers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
