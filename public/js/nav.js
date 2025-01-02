let prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    let currentScrollPos = window.pageYOffset;
    let navbar = document.querySelector(".navbar");
    let toggler = document.querySelector(".navbar-toggler");

    // Hide navbar on scroll down, show on scroll up
    if (prevScrollpos > currentScrollPos) {
        navbar.style.top = "0";  // Show when scrolling up
    } else {
        navbar.style.top = "-80px";  // Hide when scrolling down
    }

    // Collapse navbar if expanded
    if (toggler.getAttribute("aria-expanded") === "true" && prevScrollpos < currentScrollPos) {
        toggler.click();  // Simulate a click to collapse
    }

    prevScrollpos = currentScrollPos;
};

