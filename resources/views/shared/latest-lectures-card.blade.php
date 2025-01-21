<div class="w-100 mx-auto my-3 opacity-5"
    style="height: 5px;
    background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
</div>

<div class="h4 text-center mb-3 py-2 rounded shadow opacity-75"
    style="background-image:linear-gradient(to right, rgb(255, 242, 2), rgb(255, 0, 0));">
    <i class="fas fa-book me-2"></i>The Last Ten Lectures
</div>

@foreach ($semesters as $semester)
    @php
        // Filter latest lectures belonging to subjects in the current semester
        $semesterLectures = $latestLectures->filter(function ($lecture) use ($semester) {
            return $semester->subjects->pluck('id')->contains($lecture->subject_id);
        });
    @endphp

    @if ($semesterLectures->isNotEmpty())
        <div class="card shadow-sm my-3">
            <div class="card-header bg-secondary py-1">
                Semester {{ $semester->semester_number }}
            </div>
            <div class="card-body">
                @foreach ($semester->subjects as $subject)
                    @php
                        // Get latest lectures for the current subject
                        $subjectLectures = $semesterLectures->where('subject_id', $subject->id);
                    @endphp

                    @if ($subjectLectures->isNotEmpty())
                        <h5 class="text-primary my-2">{{ $subject->Subject_name }} - {{ $subject->Subject_lecturer }}</h5>
                        <!-- Ensure horizontal scroll for the table -->
                        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch; border-radius: 8px;">
                            <table class="table table-hover table-bordered table-striped lecture-table" style="min-width: 800px;">
                                <thead class="table-dark">
                                    <tr class="text-center align-middle">
                                        <th style="white-space: nowrap;">Lecture Title</th>
                                        <th style="white-space: nowrap;">Uploaded At</th>
                                        <th style="white-space: nowrap;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjectLectures as $lecture)
                                        <tr>
                                            <td class="table-primary text-center align-middle" style="white-space: nowrap;">
                                                {{ $lecture->title }}
                                            </td>
                                            <td class="table-warning text-center align-middle" style="white-space: nowrap;">
                                                {{ $lecture->created_at->format('Y-m-d H:i') }}
                                            </td>
                                            <td class="d-flex flex-wrap justify-content-center gap-1 align-middle" style="white-space: nowrap;">
                                                @if ($lecture->file_path)
                                                    <a href="{{ Storage::disk('r2')->url($lecture->file_path) }}"
                                                        target="_blank"
                                                        class="btn btn-primary action-btn"
                                                        style="font-size: 12px; padding: 4px 8px; border-radius: 4px;">
                                                        <i class="fas fa-file-pdf me-1"></i> View
                                                    </a>
                                                    <a href="{{ route('lectures.forceDownload', $lecture->id) }}"
                                                        class="btn btn-info action-btn"
                                                        style="font-size: 12px; padding: 4px 8px; border-radius: 4px;">
                                                        <i class="fas fa-download me-1"></i> Download
                                                    </a>
                                                @endif
                                                @can('edit files', $lecture)
                                                    <a href="{{ route('exam-papers.edit', $lecture->id) }}"
                                                        class="btn btn-secondary action-btn"
                                                        style="font-size: 12px; padding: 4px 8px; border-radius: 4px;">
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
                                                            class="btn btn-danger action-btn"
                                                            style="font-size: 12px; padding: 4px 8px; border-radius: 4px;">
                                                            <i class="fas fa-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endforeach

