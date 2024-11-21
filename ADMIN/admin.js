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

    // Load content based on the selected page
    function loadContent(page) {
        let contentHtml = '';
        switch(page) {
            case 'dashboard':
                contentHtml = `
                    <h2>Dashboard Overview</h2>
                    <div class="row mt-4">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text display-4">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Revenue</h5>
                                    <p class="card-text display-4">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">New Orders</h5>
                                    <p class="card-text display-4">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Pending Orders</h5>
                                    <p class="card-text display-4">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                break;
            case 'users':
                contentHtml = `
                    <h2>User Management</h2>
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>john@example.com</td>
                                <td>Admin</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>jane@example.com</td>
                                <td>User</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                `;
                break;
            case 'content':
                contentHtml = `
                    <h2>Content Management</h2>
                    <div class="mt-4">
                        <button class="btn btn-success mb-3">Add New Post</button>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Welcome to Our Website</td>
                                    <td>Admin</td>
                                    <td>2023-06-01</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>New Features Announcement</td>
                                    <td>John Doe</td>
                                    <td>2023-06-15</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
                break;
            case 'settings':
                contentHtml = `
                    <h2>Settings</h2>
                    <form class="mt-4">
                        <div class="mb-3">
                            <label for="siteName" class="form-label">Samgyup Paradise</label>
                            <input type="text" class="form-control" id="siteName" value="My Awesome Website">
                        </div>
                        <div class="mb-3">
                            <label for="siteDescription" class="form-label">Site Description</label>
                            <textarea class="form-control" id="siteDescription" rows="3">Basta masarap dito</textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="maintenanceMode">
                            <label class="form-check-label" for="maintenanceMode">Enable Maintenance Mode</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                `;
                break;
            default:
                contentHtml = '<h2>Welcome</h2><p>Select a page from the sidebar to get started.</p>';
        }
        content.innerHTML = contentHtml;
    }

    // Load dashboard by default
    loadContent('dashboard');
});

