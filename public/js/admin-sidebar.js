/**
 * Admin Sidebar Functionality
 * Handles: Desktop Collapsing, Mobile Overlay, and Active Link Highlighting
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. DOM Elements
    const sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
    const adminSidebar = document.getElementById('admin-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const topHeader = document.getElementById('top-header');
    
    // Target the main content area (matches the ID used in our dashboard.php)
    const mainContent = document.getElementById('main-content');

    // 2. Toggle Functionality
    if (sidebarToggleBtn) {
        sidebarToggleBtn.addEventListener('click', () => {
            const isDesktop = window.innerWidth >= 1024;

            if (isDesktop) {
                // DESKTOP: Toggle 'collapsed' classes defined in partials.css
                adminSidebar.classList.toggle('sidebar-collapsed');
                
                // Toggle expansion of the header and main content to fill the screen
                if (topHeader) topHeader.classList.toggle('header-expanded');
                if (mainContent) mainContent.classList.toggle('main-expanded');
            } else {
                // MOBILE: Toggle drawer 'open' class
                adminSidebar.classList.toggle('sidebar-open');
                
                // Manage the backdrop overlay
                if (sidebarOverlay.classList.contains('hidden')) {
                    sidebarOverlay.classList.remove('hidden');
                    // Small timeout to allow transition opacity to trigger
                    setTimeout(() => sidebarOverlay.classList.replace('opacity-0', 'opacity-100'), 10);
                } else {
                    sidebarOverlay.classList.replace('opacity-100', 'opacity-0');
                    setTimeout(() => sidebarOverlay.classList.add('hidden'), 300);
                }
            }
        });
    }

    // 3. Close Sidebar via Overlay (Mobile Only)
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', () => {
            adminSidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => sidebarOverlay.classList.add('hidden'), 300);
        });
    }

    // 4. Window Resize Handler
    // Prevents mobile states from breaking desktop layout when resizing browser
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            adminSidebar.classList.remove('sidebar-open');
            if (sidebarOverlay) {
                sidebarOverlay.classList.add('hidden');
                sidebarOverlay.classList.replace('opacity-100', 'opacity-0');
            }
        }
    });

    // 5. Active Link Highlighting Logic
    const highlightActiveLink = () => {
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        // Get the current file name (e.g., 'dashboard.php') from the path
        const currentPath = window.location.pathname.split('/').pop();

        sidebarLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;
            
            // Extract the filename from the href (e.g., if href is '../admin/dashboard.php')
            const linkPath = href.split('/').pop();

            if (linkPath === currentPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    };

    // Initialize active link on load
    highlightActiveLink();
});