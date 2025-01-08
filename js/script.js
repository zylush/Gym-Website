document.addEventListener('DOMContentLoaded', function () {
    const sidebarLinks = document.querySelectorAll('.sidebar .menu li a');
    const sections = document.querySelectorAll('.content section');

    // Handle sidebar active class toggling and content switching
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Remove 'active' class from all links and sections
            sidebarLinks.forEach(link => link.classList.remove('active'));
            sections.forEach(section => section.classList.remove('active'));

            // Add 'active' class to the clicked link and the corresponding section
            link.classList.add('active');
            const sectionId = link.getAttribute('data-section');
            document.getElementById(sectionId).classList.add('active');
        });
    });

    // Set the default active section to be Membership Overview
    const defaultActiveLink = document.querySelector('.menu li a.active');
    if (defaultActiveLink) {
        defaultActiveLink.click();
    }
});
