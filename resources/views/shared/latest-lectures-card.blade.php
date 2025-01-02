<div class="w-100 mx-auto my-3 opacity-5"
    style="height: 5px;
    background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
</div>

<div class="h4 text-center mb-3 py-2 rounded shadow opacity-75"
    style="background-image:linear-gradient(to right, rgb(255, 242, 2), rgb(255, 0, 0));">
    <i class="fas fa-book me-2"></i>The Last Ten Lectures
</div>
<div class="card shadow-sm shadow-black my-3">
    <div class="card-body">
        @if ($latestLectures->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped shadow-black shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Title</th>
                            <th class="text-center">Lecturer</th>
                            <th class="text-center">Subject</th>
                            <th class="d-none d-md-table-cell text-center">Uploaded At</th>
                            <th class="text-center" style="min-width: 280px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestLectures as $lecture)
                            <tr>
                                <td class="table-primary text-center align-middle text-truncate"
                                    style="max-width: 70px;">{{ $lecture->title }}</td>
                                <td class="table-secondary text-center align-middle text-truncate"
                                    style="max-width: 70px;">{{ $lecture->lecturer }}</td>
                                <td class="table-success text-center align-middle text-truncate"
                                    style="max-width: 70px;">{{ $lecture->subject->Subject_name }}</td>
                                <td class="table-warning d-none d-md-table-cell text-center align-middle">
                                    {{ $lecture->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="d-flex flex-wrap justify-content-center gap-1 align-middle">
                                    @auth
                                        @if ($lecture->file_path)
                                            <a href="{{ asset('storage/' . $lecture->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-primary d-flex align-items-center">
                                                <i class="fas fa-file-pdf me-1"></i> View
                                            </a>
                                            @can('download files', $lecture)
                                                <a href="{{ asset('storage/' . $lecture->file_path) }}" download
                                                    class="btn btn-sm btn-info d-flex align-items-center">
                                                    <i class="fas fa-download me-1"></i> Download
                                                </a>
                                            @endcan
                                        @endif
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}"
                                            class="btn btn-sm btn-primary d-flex align-items-center">
                                            <i class="fas fa-file-pdf me-1"></i> View
                                        </a>
                                        <a href="{{ route('login') }}"
                                            class="btn btn-sm btn-info d-flex align-items-center">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    @endguest
                                    @can('edit files', $lecture)
                                        <a href="{{ route('lectures.edit', $lecture->id) }}"
                                            class="btn btn-sm btn-secondary d-flex align-items-center">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    @endcan
                                    @can('delete files', $lecture)
                                        <form action="{{ route('lectures.destroy', $lecture->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this lecture?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center">
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
        @else
            <p class="text-muted">No lectures have been uploaded yet.</p>
        @endif
    </div>
</div>
