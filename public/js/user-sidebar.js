document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
    const userSidebar = document.getElementById('user-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const header = document.getElementById('top-header');
    
    // We assume your main content area is wrapped in a <main id="main-content"> tag.
    // If it isn't, you should add id="main-content" to your main wrapper in your layout.
    const mainContent = document.getElementById('main-content') || document.querySelector('main');

    // Toggle logic for Desktop and Mobile
    if (sidebarToggleBtn) {
        sidebarToggleBtn.addEventListener('click', () => {
            const isDesktop = window.innerWidth >= 1024;

            if (isDesktop) {
                // Desktop: Toggle collapse states
                userSidebar.classList.toggle('sidebar-collapsed');
                if (header) header.classList.toggle('header-expanded');
                if (mainContent) mainContent.classList.toggle('main-expanded');
            } else {
                // Mobile: Toggle open state and overlay
                userSidebar.classList.toggle('sidebar-open');
                
                if (sidebarOverlay.classList.contains('hidden')) {
                    // Show overlay with fade effect
                    sidebarOverlay.classList.remove('hidden');
                    // Small delay to allow display:block to apply before changing opacity
                    setTimeout(() => sidebarOverlay.classList.remove('opacity-0'), 10);
                } else {
                    // Hide overlay
                    sidebarOverlay.classList.add('opacity-0');
                    setTimeout(() => sidebarOverlay.classList.add('hidden'), 300); // Wait for transition
                }
            }
        });
    }

    // Close sidebar when clicking the overlay (Mobile only)
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', () => {
            userSidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.add('opacity-0');
            setTimeout(() => sidebarOverlay.classList.add('hidden'), 300);
        });
    }

    // Handle Window Resize to reset states safely
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            // Remove mobile states when resizing to desktop
            userSidebar.classList.remove('sidebar-open');
            if (sidebarOverlay) {
                sidebarOverlay.classList.add('hidden', 'opacity-0');
            }
        }
    });

    // Highlight the current active page in the sidebar
    const highlightActiveLink = () => {
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        // Get current path, ignore URL parameters (e.g., ?id=1)
        const currentPath = window.location.pathname.split('/').pop().split('?')[0];

        sidebarLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;
            
            // Clean up the href to just the filename
            const linkPath = href.split('/').pop().split('?')[0];

            if (linkPath === currentPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    };

    highlightActiveLink();
});