        const sidebar = document.querySelector('.sidebar');
        const openButton = document.querySelector('.open-button');
        const closeButton = document.querySelector('.close-button');
        const backdrop = document.querySelector('.backdrop');
        const content = document.querySelector('.content');

        // Function to open the sidebar
        function openSidebar() {
            sidebar.style.left = '0';
            content.style.marginLeft = '0';
        }

        // Function to close the sidebar
        function closeSidebar() {
            sidebar.style.left = '-250px';
            content.style.marginLeft = '0';
        }

        // Toggle the sidebar and backdrop
        function toggleSidebar() {
            /*if (sidebar.style.left === '0px') {
                closeSidebar();
            } else {
                openSidebar();
            }*/
            sidebar.classList.toggle("open");
        }

        // Open the sidebar when clicking the open button
        openButton.addEventListener('click', openSidebar);

        // Close the sidebar when clicking the close button
        closeButton.addEventListener('click', closeSidebar);

        // Close the sidebar when clicking outside of it
        backdrop.addEventListener('click', closeSidebar);
