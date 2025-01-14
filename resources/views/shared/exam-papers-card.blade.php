@if ($subject->examPapers->count() > 0)
<div class="list-group">
    <div class="w-100 mx-auto my-3 opacity-5"
        style="height: 3px;
        background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
    </div>
    @foreach ($subject->examPapers as $paper)
        <div
            class="list-group-item 
            list-group-item-action d-flex 
            flex-column flex-md-row 
            justify-content-between 
            align-items-md-center
            border-0">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                <div>
                    <h5 class="mb-0">{{ $paper->title }}</h5>
                    <small
                        class="text-muted d-none d-lg-inline">{{ $paper->created_at->format('F j, Y') }}</small>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row gap-2 justify-content-start justify-content-lg-end align-items-center">
                <a href="{{ Storage::disk('r2')->url($paper->file_path);}}"
                    target="_blank"
                    class="btn btn-sm btn-primary d-flex align-items-center justify-content-center w-100 w-lg-auto">
                    <i class="fas fa-file-pdf me-1"></i> View
                </a>
                <a href="{{ route('exam-papers.download', $paper->id) }}"
                    class="btn btn-sm btn-success d-flex align-items-center justify-content-center w-100 w-lg-auto">
                    <i class="fas fa-download me-1"></i> Download
                </a>
                @can('edit files', $paper)
                    <a href="{{ route('exam-papers.edit', $paper->id) }}"
                        class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center w-100 w-lg-auto">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('exam-papers.destroy', $paper->id) }}"
                        method="POST" class="d-inline w-100 w-lg-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-sm btn-danger d-flex align-items-center justify-content-center w-100"
                            onclick="return confirm('Are you sure you want to delete this exam paper?')">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                @endcan
                <a type="button"
                    class="btn btn-sm btn-warning d-flex align-items-center justify-content-center text-white w-100 w-lg-auto"
                    data-bs-toggle="modal"
                    data-bs-target="#examPaperInfoModal"
                    data-description="{{ $paper->description }}"
                    data-title="{{ $paper->title }}">
                    <i class="fa-solid fa-circle-info me-1"></i> Description
                </a>
            </div>
            
        </div>
        <div class="w-100 mx-auto my-3 opacity-5"
            style="height: 3px;
    background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
        </div>
    @endforeach
</div>
@else
<p class="text-muted">No exam papers available for this subject.</p>
@endif
