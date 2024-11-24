<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samgyup - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="../MAIN/main.html" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Admin Dashboard</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="?page=dashboard" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=users" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=content" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-file-earmark-text"></i> <span class="ms-1 d-none d-sm-inline">Content</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=settings" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-gear"></i> <span class="ms-1 d-none d-sm-inline">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col py-3 main-content">
                <?php
                // Dynamically load content based on 'page' parameter
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

                require_once '../ADMIN/dashboard_function.php';
                require_once '../ADMIN/userAdmin_function.php';

                $dashboardFunctions = new DashboardFunctions();
                $userAdmin = new UserAdminFunction();

                $totalUsers = $dashboardFunctions->getTotalUsers();
                $totalRevenue = $dashboardFunctions->getTotalRevenue();
                $popularItem = $dashboardFunctions->getPopulatItem();
                $users = $userAdmin->getAllUsers();
                // $pendingOrders = $dashboardFunctions->getPendingOrders();
                if ($page == 'dashboard') {
                    echo '<h2>Dashboard Overview</h2>
                    <div class="row mt-4">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text display-4">'. $totalUsers .'</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Revenue</h5>
                                    <p class="card-text display-4">'. number_format($totalRevenue) .'</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Popular Item</h5>
                                    <p class="card-text display-4">'. $popularItem .'</p>
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
                    </div>';
                } elseif ($page == 'users') {
                    echo '<h2>User Management</h2>
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
                        <tbody>';
                        foreach ($users as $user) {
                            echo '<tr>
                                <td>' . htmlspecialchars($user['user_id']) . '</td>
                                <td>' . htmlspecialchars($user['firstName']) . '</td>
                                <td>' . htmlspecialchars($user['email']) . '</td>
                                <td>' . htmlspecialchars($user['role'] ?? 'User') . '</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteUser(' . htmlspecialchars($user['user_id']) . ')">Delete</button>
                                </td>
                            </tr>';
                        }
                    
                        echo '</tbody>
                        </table>';
                } elseif ($page == 'content') {
                    echo '<h2>Content Management</h2>
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
                    </div>';
                } elseif ($page == 'settings') {
                    echo '<h2>Settings</h2>
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
                    </form>';
                } else {
                    echo '<h2>Page Not Found</h2>
                        <p>The page you are looking for does not exist.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../ADMIN/admin.js"></script>
</body>
</html>
