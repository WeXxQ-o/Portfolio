/**
 * Admin Panel General Scripts
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const sidebar = document.getElementById('adminSidebar');
    const toggleBtn = document.getElementById('mobileMenuToggle');

    if (sidebar && toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
});

/**
 * Confirm delete actions
 */
function confirmDelete(message) {
    return confirm(message || 'Are you sure you want to delete this item?');
}
