document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.col-auto');
    const toggleButton = document.getElementById('toggle-sidebar');
    const content = document.getElementById('content');
    const navLinks = document.querySelectorAll('.nav-link');

    // Toggle sidebar
    toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
    });

    // Handle navigation
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            const page = this.getAttribute('data-page');
            loadContent(page);
        });
    });
});

