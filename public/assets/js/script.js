/////// Sidebar Navigation and Active State Handling

document.addEventListener('DOMContentLoaded', function () {
    // Sidebar elements
    const sidebar = document.getElementById('sidebarPremium');
    const sidebarToggle = document.getElementById('sidebarTogglePremium');
    const sidebarBackdrop = document.getElementById('sidebarBackdropPremium');
    const sidebarToggler = sidebar.querySelector('.sidebar-toggler');
    const body = document.body;
    const mainContent = document.querySelector('.main-content');

    // Toggle sidebar collapse/expand
    function toggleSidebar() {
        sidebar.classList.toggle('collapsed');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        adjustMainContent();
    }

    // Adjust main content padding based on sidebar state
    function adjustMainContent() {
        if (sidebar.classList.contains('collapsed')) {
            body.style.paddingRight = '10px';
            // if (mainContent) {
            //     mainContent.style.marginRight = 'var(--sidebar-collapsed-width)';
            // }
        } else {
            body.style.paddingRight = 'var(--sidebar-width)';
            // if (mainContent) {
            //     mainContent.style.marginRight = 'var(--sidebar-width)';
            // }
        }
    }

    // Toggle sidebar on mobile
    function toggleMobileSidebar() {
        sidebar.classList.toggle('show');
        sidebarBackdrop.classList.toggle('show');
        document.body.classList.toggle('overflow-hidden');
    }

    // Initialize sidebar state
    function initSidebar() {
        // Set initial state from localStorage
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
        }
        adjustMainContent();

        // Set active menu item based on current URL
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar-premium .nav-link');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href)) {
                link.classList.add('active');

                // Expand parent collapse if this is a submenu item
                const parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    const collapseTrigger = document.querySelector(`[href="#${parentCollapse.id}"]`);
                    if (collapseTrigger) {
                        collapseTrigger.classList.add('active');
                        collapseTrigger.setAttribute('aria-expanded', 'true');
                        parentCollapse.classList.add('show');
                    }
                }
            }

            // Handle click events
            link.addEventListener('click', function (e) {
                if (this.hasAttribute('data-bs-toggle')) return;

                // Remove active class from all links
                navLinks.forEach(l => l.classList.remove('active'));

                // Add active class to clicked link
                this.classList.add('active');

                // Save active state to localStorage
                localStorage.setItem('activeLink', this.getAttribute('href'));
            });
        });

        // Close other collapses when one opens (accordion behavior)
        const collapseTriggers = document.querySelectorAll('[data-bs-toggle="collapse"]');
        collapseTriggers.forEach(trigger => {
            trigger.addEventListener('click', function () {
                const targetId = this.getAttribute('href');
                const isShowing = this.classList.contains('collapsed');

                if (isShowing) {
                    // Close all other open collapses in the same sidebar
                    document.querySelectorAll('.sidebar-premium .collapse.show').forEach(openCollapse => {
                        if (openCollapse.id !== targetId.substring(1)) {
                            const bsCollapse = bootstrap.Collapse.getInstance(openCollapse);
                            if (bsCollapse) bsCollapse.hide();
                        }
                    });
                }
            });
        });
    }

    // Event listeners
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleMobileSidebar);
    }

    if (sidebarBackdrop) {
        sidebarBackdrop.addEventListener('click', toggleMobileSidebar);
    }

    if (sidebarToggler) {
        sidebarToggler.addEventListener('click', toggleSidebar);
    }

    // Initialize
    initSidebar();

    // Responsive adjustments
    function handleResize() {
        if (window.innerWidth < 992) {
            sidebar.classList.remove('collapsed');
            body.style.paddingRight = '0';
            if (mainContent) {
                mainContent.style.marginRight = '0';
            }
        } else {
            adjustMainContent();
        }
    }

    window.addEventListener('resize', handleResize);
    handleResize(); // Run once on load
});

//////   Date-Time Auto Update

function updateDateTimeOnceIfEmpty() {
    const dateTimeInput = document.getElementById('dateBuy');
    if (dateTimeInput && !dateTimeInput.value) {
        const now = new Date();

        // Create a string in 'YYYY-MM-DDTHH:mm' format based on local time
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        dateTimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
    }
}

document.addEventListener('DOMContentLoaded', updateDateTimeOnceIfEmpty);


////////   Delete Alert
window.addEventListener('show-delete-confirmation', event => {
    Swal.fire({
        title: "هل أنت متأكد؟",
        text: "لن تتمكن من التراجع!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "نعم، احذفه!"
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch('deleteConfirmed')
        }
    });
});

window.addEventListener('driverDelete', event => {
    Swal.fire(
        'تم الحذف!',
        'تم حذف السائق بنجاح.',
        'success'
    )
});


