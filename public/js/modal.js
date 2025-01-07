


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