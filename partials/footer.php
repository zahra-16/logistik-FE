</div> </main> </div> <script src="script.js"></script>
<script>
    // Basic JS to show/hide pages based on sidebar clicks
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            
            // Update page title in header
            const titleMap = {
                'dashboard-page': 'Dashboard',
                'user-management-page': 'Manajemen User',
                'item-data-page': 'Master Data Item',
                // ... add other mappings ...
            };
            document.getElementById('page-title').textContent = titleMap[targetId] || 'Page';

            // Hide all pages
            document.querySelectorAll('.page-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block'); // Assuming you use block/hidden for visibility
            });

            // Show target page
            const targetPage = document.getElementById(targetId);
            if (targetPage) {
                targetPage.classList.remove('hidden');
                targetPage.classList.add('block');
            }

            // Update active link styling
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active', 'bg-indigo-100', 'text-indigo-700'));
            this.classList.add('active', 'bg-indigo-100', 'text-indigo-700'); // Adjust styling based on your actual CSS for 'active'
        });
    });
    // Set initial active state for Dashboard
    document.querySelector('.sidebar-link.active').classList.add('bg-indigo-100', 'text-indigo-700'); // Apply initial color change
</script>
</body>
</html>