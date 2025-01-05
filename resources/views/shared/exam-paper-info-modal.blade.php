<!-- Modal for examPaper Description -->
<div class="modal fade" id="examPaperInfoModal" tabindex="-1" aria-labelledby="examPaperInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header rounded-top-4">
                <h5 class="modal-title" id="examPaperInfoModalLabel">examPaper Description</h5>
                <button type="button" class="btn-close btn-close-darck" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted" id="examPaperModalBody">
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
        const examPaperInfoButtons = document.querySelectorAll('[data-bs-target="#examPaperInfoModal"]');

        examPaperInfoButtons.forEach(button => {
            button.addEventListener('click', function() {
                const examPaperTitle = button.getAttribute('data-title');
                const examPaperDescription = button.getAttribute('data-description') ||
                    'No description available.';

                const modalTitle = document.querySelector('#examPaperInfoModalLabel');
                const modalBody = document.querySelector('#examPaperModalBody');

                modalTitle.textContent = examPaperTitle;
                modalBody.textContent = examPaperDescription;
            });
        });
    });
</script>

