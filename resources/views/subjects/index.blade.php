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
                        <a href="{{ route('subjects.create') }}" class="btn text"
                            style="background-color: #ff9100; border-bottom: 2px solid #e68400;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Add
                            New Subject</a>
                    </div>
                </div>
            @endif
        @endauth
        <h1 class="text-center m-4 " style="text-color:black; font-weight:bold;">All Subjects from all Semester</h1>

        @foreach ($semesters as $semester)
            <div class="accordion" id="accordionExample">
                <div class="accordion-item mb-1">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSemester{{ $semester->id }}" aria-expanded="false"
                            data-bs-parent="#accordionExample"
                            aria-controls="collapseSemester{{ $semester->id }}">
                            Semester {{ $semester->semester_number }}
                        </button>
                    </h2>
                    <div id="collapseSemester{{ $semester->id }}" class="collapse according-collapse"
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            @if ($semester->subjects->count() > 0)
                                <div class="table-container shadow-lg p-4 mb-5 bg-white rounded" style="overflow-x: auto;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h2 style="text-color:black; font-weight:bold;">Subjects Overview</h2>
                                        <a href="{{ route('subjects.create') }}" class="btn btn-success"
                                            style="background-color: #28a745; border-color: #28a745;">Add New Subject</a>
                                    </div>
                                    <table class="table table-hover bg-white align-middle">
                                        <thead class="bg-gradient text-dark">
                                            <tr>
                                                <th class="text-center text-dark" style="width: 30%; background-color: #feebd5;">
                                                    Subject Name
                                                </th>
                                                <th class="text-center text-dark" style="width: 30%; background-color: #feebd5;">
                                                    Lecturer Name
                                                </th>
                                                <th class="text-center text-dark" style="width: 40%; background-color: #feebd5;">
                                                    Access</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($semester->subjects as $subject)
                                                <tr style="cursor: pointer;"
                                                    onmouseover="this.style.backgroundColor='#d4edda'"
                                                    onmouseout="this.style.backgroundColor='';">
                                                    <td class="text-center bg-white" >
                                                        {{ $subject->Subject_name }}</td>
                                                    <td class="text-center bg-white" >
                                                        {{ $subject->Subject_lecturer }}</td>
                                                    <td class="text-center d-flex justify-content-center bg-white">
                                                        <a href="{{ route('subjects.show', $subject->id) }}"
                                                            class="btn btn-primary me-2 btn-sm"
                                                            style="transition: all 0.3s ease; min-width: 60px;">View</a>
                                                        @can('edit subjects')
                                                            <a href="{{ route('subjects.edit', $subject->id) }}"
                                                                class="btn btn-warning me-2 btn-sm"
                                                                style="transition: all 0.3s ease; min-width: 60px;">Edit</a>
                                                        @endcan
                                                        @can('delete subjects')
                                                            <form action="{{ route('subjects.destroy', $subject->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    style="transition: all 0.3s ease; min-width: 60px;">Delete</button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-center">No subjects found for this semester.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
