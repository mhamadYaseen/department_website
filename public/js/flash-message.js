   document.addEventListener('DOMContentLoaded', function() {
      const initializeFlashMessages = () => {
          const messages = document.querySelectorAll('.alert');

          messages.forEach(message => {
              // Show the message by adding 'show' class
              message.classList.add('show');

              // Auto dismiss after 2 seconds
              setTimeout(() => {
                  message.classList.remove('show');
                  setTimeout(() => {
                      message.remove();  // Completely removes the element
                  }, 500);  // Matches CSS transition duration
              }, 2000);  // Alert visible for 2 seconds

              // Close button handler (removes immediately on click)
              const closeButton = message.querySelector('.btn-close');
              if (closeButton) {
                  closeButton.addEventListener('click', () => {
                      message.classList.remove('show');
                     
                      // Remove after fade-out
                      setTimeout(() => {
                          message.remove();
                      }, 500);
                  });
              }
          });
      };
      
      initializeFlashMessages();
   });
