@if ($subject->lectures->count() > 0)
<ul class="list-group list-group-flush">
    <div class="w-100 mx-auto my-3 opacity-5"
        style="height: 3px;
            background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
    </div>
    @foreach ($subject->lectures as $lecture)
        <li
            class="list-group-item 
                list-group-item-action d-flex 
                flex-column flex-md-row 
                justify-content-between 
                align-items-md-center
                border-0">

            <div
                class="d-flex align-items-center justify-content-center justify-content-lg-start w-100 mb-2 mb-md-0">
                <i
                    class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                <div class="text-center text-lg-start">
                    <h5 class="mb-0">{{ $lecture->title }}
                    </h5>
                    <small
                        class="text-muted d-none d-lg-inline">{{ $lecture->created_at->format('F j, Y') }}</small>
                </div>
            </div>

            <div
                class="row g-2 align-items-center justify-content-end w-100">
                <div class="col-12 col-md-auto  ">
                    <a href="{{Storage::disk('r2')->url($lecture->file_path); }}"
                        target="_blank"
                        class="btn btn-sm text-center justify-content-center btn-primary d-flex align-items-center ">
                        <i class="fas fa-file-pdf me-1"></i>
                        View
                    </a>
                </div>
                <div class="col-12 col-md-auto">
                    <a href="{{ route('lectures.forceDownload', $lecture->id) }}"
                       class="btn btn-sm text-center justify-content-center btn-info d-flex align-items-center w-100">
                        <i class="fas fa-download me-1"></i>
                        Download
                    </a>
                </div>
                             
                @can('edit files', $lecture)
                    <div class="col-12 col-md-auto  ">
                        <a href="{{ route('lectures.edit', $lecture->id) }}"
                            class="btn btn-sm text-center justify-content-center btn-secondary d-flex align-items-center w-100">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                    </div>
                @endcan

                @can('delete files', $lecture)
                    <div class="col-12 col-md-auto  ">
                        <form
                            action="{{ route('lectures.destroy', $lecture->id) }}"
                            method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm text-center justify-content-center btn-danger d-flex align-items-center w-100">
                                <i class="fas fa-trash me-1"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                @endcan

                <div class="col-12 col-md-auto  ">
                    <a type="button"
                        class="btn btn-sm text-center justify-content-center btn-warning d-flex align-items-center w-100 text-white"
                        data-bs-toggle="modal"
                        data-bs-target="#lectureInfoModal"
                        data-description="{{ $lecture->description }}"
                        data-title="{{ $lecture->title }}">
                        <i
                            class="fa-solid fa-circle-info fa-lg me-1"></i>
                        Description
                    </a>
                </div>
            </div>
        </li>

        {{-- Lecture Info Modal --}}

        <div class="w-100 mx-auto my-3 opacity-5"
            style="height: 3px;
                background-image: linear-gradient(to right, rgb(249, 255, 67), rgb(255, 0, 0));">
        </div>
    @endforeach
</ul>
@else
<p class="text-muted">No lectures available.</p>
@endif