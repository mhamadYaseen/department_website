<div class="card">
    <div class="card-header">Latest Ten Lectures</div>
    <div class="card-body">
        @if ($latestLectures->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Lecturer</th>
                            <th>Subject</th>
                            <th>Uploaded At</th>
                            <th style="min-width: 280px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestLectures as $lecture)
                            <tr>
                                <td>{{ $lecture->title }}</td>
                                <td>{{ $lecture->lecturer }}</td>
                                <td>{{ $lecture->subject->Subject_name }}</td>
                                <td>{{ $lecture->created_at->format('Y-m-d H:i') }}</td>
                                <td class="d-flex gap-1">
                                    @if ($lecture->file_path)
                                        @can('view files', $lecture)
                                            <a href="{{ asset('storage/' . $lecture->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary w-100">
                                                <i class="fas fa-file-pdf"></i> View
                                            </a>
                                        @endcan

                                        @can('download files', $lecture)
                                            <a href="{{ asset('storage/' . $lecture->file_path) }}" download
                                                class="btn btn-sm btn-outline-info w-100">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        @endcan
                                    @endif

                                    @can('edit files', $lecture)
                                        <a href="{{ route('lectures.edit', $lecture->id) }}"
                                            class="btn btn-sm btn-outline-secondary w-100">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endcan

                                    @can('delete files', $lecture)
                                        <form action="{{ route('lectures.destroy', $lecture->id) }}" method="POST"
                                            class="d-inline w-100"
                                            onsubmit="return confirm('Are you sure you want to delete this lecture?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No lectures have been uploaded yet.</p>
        @endif
    </div>
</div>
