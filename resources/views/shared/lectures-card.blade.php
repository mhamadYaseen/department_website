<h3>Lectures</h3>
@if ($subject->lectures->count() > 0)
    <ul class="list-group">
        @foreach ($subject->lectures as $lecture)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-primary">{{ $lecture->title }}</span>
                <div class="btn-group">
                    @if ($lecture->file_path)
                        <a href="{{ asset('storage/' . $lecture->file_path) }}" target="_blank"
                            class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-file-pdf"></i> View
                        </a>

                    @can('download files', $lecture)
                        <a href="{{ asset('storage/' . $lecture->file_path) }}" download
                            class="btn btn-sm btn-outline-info w-100">
                            <i class="fas fa-download"></i> Download
                        </a>
                    @endcan

                @endif
                @guest
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary w-100">
                        <i class="fas fa-file-pdf"></i> View
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-info w-100">
                        <i class="fas fa-download"></i> Download
                    </a>
                @endguest

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
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted">No lectures available.</p>
@endif