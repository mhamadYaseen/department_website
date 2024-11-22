<div class="card-body border ">
    <h3>Lectures</h3>
    @if ($subject->lectures->count() > 0)
         <ul class="list-group">
              @foreach ($subject->lectures as $lecture)
                    <li class="list-group-item d-flex justify-content-between align-items-center text-primary">
                         {{ $lecture->title }}
                         <a href="{{ asset('storage/' . $lecture->file_path) }}" class="btn btn-sm btn-primary"
                              target="_blank">
                              View PDF
                         </a>
                    </li>
              @endforeach
         </ul>
    @else
         <p class="text-muted">No lectures available for this subject.</p>
    @endif
</div>