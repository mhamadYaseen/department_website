<footer class="shadow-sm mt-2 py-3 border-black border-top " style="background-color: #f3f3f3d8;">
   <div class="container text-center">
      <div class="row justify-content-center">
         <div class="col-12 col-md-8">
            <p class="mb-1 small">&copy; {{ date('Y') }} Department of Software, University of Salahaddin, Erbil</p>
            <p class="mb-1 small">Developed by: 
               <a href="https://www.linkedin.com/in/mhamad-yaseen" class="text-decoration-none" target="_blank" rel="noopener noreferrer">Muhammad Yaseen</a>
            </p>
            <p class="text-muted small">We would love to hear your feedback and suggestions!</p>
            <button class="btn btn-primary btn-sm hover-shadow" data-bs-toggle="modal" data-bs-target="#feedbackModal">
               <i class="fas fa-comment-dots me-2"></i>Send Feedback
            </button>
            <p class="text-muted small">If there are any updates on lectures or other information,<br> you can contact me on Telegram: 
               <a href="https://t.me/Mhamadyaseen" class="text-decoration-none" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-telegram fa-xl"></i></a>
            </p>
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
                  <label for="name" class="form-label small">Your Name</label>
                  <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" 
                         id="name" name="name" value="{{ old('name') }}" required>
                  @error('name')<div class="invalid-feedback small">{{ $message }}</div>@enderror
               </div>

               <div class="mb-3">
                  <label for="email" class="form-label small">Your Email</label>
                  <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" 
                         id="email" name="email" value="{{ old('email') }}" required>
                  @error('email')<div class="invalid-feedback small">{{ $message }}</div>@enderror
               </div>

               <div class="mb-3">
                  <label for="message" class="form-label small">Your Feedback</label>
                  <textarea class="form-control form-control-sm @error('message') is-invalid @enderror" 
                            id="message" name="message" rows="3" required>{{ old('message') }}</textarea>
                  @error('message')<div class="invalid-feedback small">{{ $message }}</div>@enderror
               </div>

               <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-sm">Submit Feedback</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
