/**
 * Spillburg Logistics 1 (Private) Limited
 * Core Frontend Interactions & Responsive Navigation
 */

document.addEventListener('DOMContentLoaded', () => {
    // Public Mobile Navigation Drawer Toggle
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    const drawer = document.querySelector('.mobile-nav-drawer');
    const closeBtn = document.querySelector('.drawer-close-btn');

    if (toggleBtn && drawer) {
        toggleBtn.addEventListener('click', () => {
            drawer.classList.add('open');
            document.body.style.overflow = 'hidden';
            if (closeBtn) closeBtn.focus();
        });

        const closeDrawer = () => {
            drawer.classList.remove('open');
            document.body.style.overflow = '';
            toggleBtn.focus();
        };

        if (closeBtn) {
            closeBtn.addEventListener('click', closeDrawer);
        }

        drawer.addEventListener('click', (e) => {
            if (e.target === drawer) {
                closeDrawer();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && drawer.classList.contains('open')) {
                closeDrawer();
            }
        });
    }

    // Admin Sidebar Mobile Toggle
    const adminToggleBtn = document.getElementById('adminSidebarToggle');
    const adminSidebar = document.getElementById('adminSidebar');
    const adminBackdrop = document.getElementById('adminSidebarBackdrop');
    const adminCloseBtn = document.getElementById('adminSidebarClose');

    if (adminToggleBtn && adminSidebar) {
        const openAdminSidebar = () => {
            adminSidebar.classList.add('open');
            if (adminBackdrop) adminBackdrop.classList.add('open');
            document.body.style.overflow = 'hidden';
        };

        const closeAdminSidebar = () => {
            adminSidebar.classList.remove('open');
            if (adminBackdrop) adminBackdrop.classList.remove('open');
            document.body.style.overflow = '';
        };

        adminToggleBtn.addEventListener('click', openAdminSidebar);
        if (adminCloseBtn) adminCloseBtn.addEventListener('click', closeAdminSidebar);
        if (adminBackdrop) adminBackdrop.addEventListener('click', closeAdminSidebar);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && adminSidebar.classList.contains('open')) {
                closeAdminSidebar();
            }
        });
    }

    // Auto-dismiss Alerts after 7 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            setTimeout(() => alert.remove(), 500);
        }, 7000);
    });

    // Interactive Tabular Filters or Data Table sorting if present
    const tableSearchInput = document.getElementById('tableSearch');
    if (tableSearchInput) {
        tableSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.logistics-table tbody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }
});
