<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40  h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar" style="width: 16.6rem">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
        <button id="close-sidebar" class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg block md:hidden">
            <span class="sr-only">Close sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 9.586L14.293 5.293a1 1 0 011.414 1.414L11.414 11l4.293 4.293a1 1 0 01-1.414 1.414L10 12.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 11 4.293 6.707A1 1 0 015.707 5.293L10 9.586z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <a href="/">
            <h1 class="flex gap-1 text-4xl text-white mt-4 mb-12 md:my-12 font-serif">
                <p>Bookify</p>
                <span class="text-lg flex items-end font-mono text-blue-400">Shelves</span>
            </h1>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/"
                    class="flex items-center p-2 mb-3 rounded-lg text-white hover:bg-gray-100 hover:text-gray-800 group">
                    <span class="ms-3">Home</span>
                </a>
                <a href="#"
                    class="flex items-center p-2 mb-3 rounded-lg text-white hover:bg-gray-100 hover:text-gray-800 group">
                    <span class="ms-3">Books</span>
                </a>
                <a href="#"
                    class="flex items-center p-2 mb-3 rounded-lg text-white hover:bg-gray-100 hover:text-gray-800 group">
                    <span class="ms-3">Author</span>
                </a>
                <a href="#"
                    class="flex items-center p-2 mb-3 rounded-lg text-white hover:bg-gray-100 hover:text-gray-800 group">
                    <span class="ms-3">Contact US</span>
                </a>
                <a href="#"
                    class="flex items-center p-2 mb-3 rounded-lg text-white hover:bg-gray-100 hover:text-gray-800 group">
                    <span class="ms-3">About US</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('[data-drawer-toggle="logo-sidebar"]');
        const closeButton = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('logo-sidebar');

        toggleButton.addEventListener('click', toggleSidebar);

        if (closeButton) {
            closeButton.addEventListener('click', closeSidebar);
        }

        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                closeSidebar();
            }
        });

        // Close sidebar when exiting full-screen mode
        document.addEventListener('fullscreenchange', function() {
            if (!document.fullscreenElement) {
                closeSidebar();
            }
        });

        function toggleSidebar() {
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
            } else {
                closeSidebar();
            }
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
        }
    });
</script>
