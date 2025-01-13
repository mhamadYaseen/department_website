<div class="w-100 mx-auto my-3 opacity-5"
    style="height: 5px;
    background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
</div>

<div class="h4 text-center mb-3 py-2 rounded shadow opacity-75"
    style="background-image:linear-gradient(to right, rgb(255, 242, 2), rgb(255, 0, 0));">
    <i class="fas fa-book me-2"></i>The Last Ten Lectures
</div>

@foreach ($semesters as $semester)
    @if ($semester->subjects->count() > 0)
        @foreach ($semester->subjects as $subject)
            @foreach ($subject->lectures as $lecture)
                <div class="card shadow-sm my-3">
                    <div class="card-header bg-secondary py-1">Semester {{ $semester->semester_number }}</div>
                    <div class="card-body">
                        <!-- Ensure horizontal scroll for the table -->
                        <div class="table-responsive-sm"> 
                            <table class="table table-hover table-bordered table-striped lecture-table">
                                <thead class="table-dark">
                                    <tr class="text-center align-middle">
                                        <th>Lecture Title</th>
                                        <th>Subject</th>
                                        <th>Lecturer</th>
                                        <th class="d-none d-md-table-cell">Uploaded At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-primary text-center align-middle text-truncate">
                                            {{ $lecture->title }}
                                        </td>
                                        <td class="table-success text-center align-middle text-truncate">
                                            {{ $lecture->subject->Subject_name }}
                                        </td>
                                        <td class="table-secondary text-center align-middle text-truncate">
                                            {{ $lecture->subject->Subject_lecturer }}
                                        </td>
                                        <td class="table-warning d-none d-md-table-cell text-center align-middle">
                                            {{ $lecture->created_at->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="d-flex flex-wrap justify-content-center gap-1 align-middle">
                                            @if ($lecture->file_path)
                                                <a href="{{ asset('storage/' . $lecture->file_path) }}"
                                                    target="_blank"
                                                    class="btn btn-primary action-btn">
                                                    <i class="fas fa-file-pdf me-1"></i> View
                                                </a>
                                                <a href="{{ asset('storage/' . $lecture->file_path) }}" download
                                                    class="btn btn-info action-btn">
                                                    <i class="fas fa-download me-1"></i> Download
                                                </a>
                                            @endif
                                            @can('edit files', $lecture)
                                                <a href="{{ route('exam-papers.edit', $lecture->id) }}"
                                                    class="btn btn-secondary action-btn">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                            @endcan
                                            @can('delete files', $lecture)
                                                <form action="{{ route('exam-papers.destroy', $lecture->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this lecture?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger action-btn">
                                                        <i class="fas fa-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endif
@endforeach
