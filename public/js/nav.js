let lastScrollTop = 0;
const navbar = document.getElementById("navbar");

if (navbar) {
    window.addEventListener("scroll", () => {
        let currentScroll = window.scrollY;

        if (currentScroll > lastScrollTop && currentScroll > 100) {
            navbar.style.top = "-70px";  // Hides navbar on scroll down
        } else {
            navbar.style.top = "0";  // Shows navbar on scroll up
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });
}