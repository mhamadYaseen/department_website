<!-- Modal for Lecture Description -->
<div class="modal fade" id="lectureInfoModal" tabindex="-1" aria-labelledby="lectureInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header rounded-top-4">
                <h5 class="modal-title" id="lectureInfoModalLabel">Lecture Description</h5>
                <button type="button" class="btn-close btn-close-darck" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted" id="lectureModalBody">
                    No description available.
                </p>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="close-btn px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Update Modal Content Dynamically -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lectureInfoButtons = document.querySelectorAll('[data-bs-target="#lectureInfoModal"]');

        lectureInfoButtons.forEach(button => {
            button.addEventListener('click', function() {
                const lectureTitle = button.getAttribute('data-title');
                const lectureDescription = button.getAttribute('data-description') ||
                    'No description available.';

                const modalTitle = document.querySelector('#lectureInfoModalLabel');
                const modalBody = document.querySelector('#lectureModalBody');

                modalTitle.textContent = lectureTitle;
                modalBody.textContent = lectureDescription;
            });
        });
    });
</script>

