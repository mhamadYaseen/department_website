<footer class="shadow-sm mt-2 py-4 border-black border-top" style="background-color: #f3f3f3d8;">
   <div class="container text-center">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <p class="mb-2">© {{ date('Y') }} Department of Software, University of Salahaddin, Erbil</p>
            <p class="mb-2">Developed by: 
               <a href="https://www.linkedin.com/in/mhamad-yaseen" class="text-decoration-none" target="_blank" rel="noopener noreferrer">Muhammad Yaseen</a>
            </p>
            <p class="text-muted">We would love to hear your feedback and suggestions!</p>
            <button class="btn btn-primary hover-shadow" data-bs-toggle="modal" data-bs-target="#feedbackModal">
               <i class="fas fa-comment-dots me-2"></i>Send Feedback
            </button>
         </div>
      </div>
   </div>
</footer>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="feedbackModalLabel">
               <i class="fas fa-comment-alt me-2"></i>We Value Your Feedback
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('send.feedback') }}">
               @csrf
               <div class="mb-3">
                  <label for="name" class="form-label">Your Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" 
                         id="name" name="name" value="{{ old('name') }}" required>
                  @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
               </div>

               <div class="mb-3">
                  <label for="email" class="form-label">Your Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" 
                         id="email" name="email" value="{{ old('email') }}" required>
                  @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
               </div>

               <div class="mb-3">
                  <label for="message" class="form-label">Your Feedback</label>
                  <textarea class="form-control @error('message') is-invalid @enderror" 
                            id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                  @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
               </div>

               <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Submit Feedback</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Flash Message -->

