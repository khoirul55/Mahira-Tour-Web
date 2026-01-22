document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar-zen');
    if (!navbar) return;

    function updateNavbar() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    // Update on scroll
    window.addEventListener('scroll', updateNavbar, { passive: true });

    // Update on load (in case user reloads halfway down the page)
    updateNavbar();
});
