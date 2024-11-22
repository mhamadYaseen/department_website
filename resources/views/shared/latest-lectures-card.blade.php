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
                           <th>Actions</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($latestLectures as $lecture)
                           <tr>
                               <td>{{ $lecture->title }}</td>
                               <td>{{ $lecture->lecturer }}</td>
                               <td>{{ $lecture->subject->Subject_name }}</td>
                               <td>{{ $lecture->created_at->format('Y-m-d H:i') }}</td>
                               <td>
                                   <a href="{{ asset('storage/' . $lecture->file_path) }}"
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                       <i class="fas fa-file-pdf"></i> View PDF
                                   </a>
                                   <a href="{{ route('lectures.edit', $lecture->id) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                       <i class="fas fa-edit"></i> Edit
                                   </a>
                                   <form action="{{ route('lectures.destroy', $lecture->id) }}"
                                       method="POST" class="d-inline"
                                       onsubmit="return confirm('Are you sure you want to delete this lecture?');">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm btn-outline-danger">
                                           <i class="fas fa-trash"></i> Delete
                                       </button>
                                   </form>
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