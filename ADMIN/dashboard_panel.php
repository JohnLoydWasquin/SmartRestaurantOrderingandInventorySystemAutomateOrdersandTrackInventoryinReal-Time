<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samgyup - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <a href="../MAIN/main.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
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
                            <a href="?page=inventory" class="nav-link px-0 align-middle">
                                <i class="bi bi-box"></i> <span class="ms-1 d-none d-sm-inline">Menu Inventory</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=booked_tables" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Booked Tables</span>
                            </a>
                        </li>
                        <li>
                            <a href="../ADMIN/adminLogout.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-box-arrow-right"></i> <span class="ms-1 d-none d-sm-inline">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col py-3 main-content">
                <?php
                // Dynamically load content based on 'page' parameter
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

                require_once '../ADMIN/dashboard_function.php';
                require_once '../ADMIN/userAdmin_function.php';
                require_once '../ADMIN/inventoryManager.php';

                $dashboardFunctions = new DashboardFunctions();
                $userAdmin = new UserAdminFunction();
                $inventoryItems = new InventoryManager();

                // DASHBOARD OVERVIEW
                $totalUsers = $dashboardFunctions->getTotalUsers();
                $totalRevenue = $dashboardFunctions->getTotalRevenue();
                $popularItem = $dashboardFunctions->getPopulatItem();
                $loyalUser = $dashboardFunctions->getLoyalty();

                // USERS
                $users = $userAdmin->getAllUsers();

                // INVENTORY
                $items = $inventoryItems->getAllItems();
                
                // DASHBOARD PAGE
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
                                    <h5 class="card-title">Loyal Customer</h5>
                                    <p class="card-text display-4">'. $loyalUser .'</p>
                                </div>
                            </div>
                        </div>
                    </div>';
                }

                // USERS PAGE
                elseif ($page == 'users') {
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
                                    <button class="btn btn-sm btn-primary" onclick="openEditModal(
                                        \''. htmlspecialchars($user['user_id']) .'\',
                                        \''. addslashes($user['firstName']) .'\',
                                        \''. addslashes($user['email']) .'\',
                                        \''. ($user['role'] ?? 'User') .'\')">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="openDeleteModal(\''. htmlspecialchars($user['user_id']) .'\')">Delete</button>
                                </td>
                            </tr>';
                        }
                        echo '</tbody>
                    </table>';
                }

                // INVENTORY PAGE
                elseif ($page == 'inventory') {
                    echo '<h2>Inventory Management</h2>
                    <div class="mt-4">
                        <button class="btn btn-success mb-3" onclick="openAddItemModal()">Add New Item</button>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($items as $item) {
                                echo '<tr>
                                    <td>' . htmlspecialchars($item['id']) . '</td>
                                    <td>' . htmlspecialchars($item['name']) . '</td>
                                    <td>' . htmlspecialchars($item['category']) . '</td>
                                    <td>' . htmlspecialchars($item['stock']) . '</td>
                                    <td>₱' . number_format($item['price'], 2) . '</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="openEditInventoryModal(
                                            \''. addslashes($item['id']) .'\',
                                            \''. addslashes($item['name']) .'\',
                                            \''. addslashes($item['category']) .'\',
                                            \''. addslashes($item['stock']) .'\',
                                            \''. addslashes($item['price']) .'\')">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="openDeleteInventoryModal(\''. htmlspecialchars($item['id']) .'\')">Delete</button>
                                    </td>
                                </tr>';
                            }
                            echo '</tbody>
                        </table>
                    </div>';
                }

                // BOOKED TABLES PAGE
                
                // BOOKED TABLES PAGE
elseif ($page == 'booked_tables') {
    echo '<h2>Booked Tables</h2>';
    try {
        $bookedTables = $inventoryItems->getBookedTables(); // Get booked tables from database
        echo '<table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Table Number</th>
                    <th>User ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            if (!empty($bookedTables)) {
                foreach ($bookedTables as $table) {
                    echo '<tr>
                        <td>' . htmlspecialchars($table['booking_id']) . '</td>
                        <td>' . htmlspecialchars($table['table_number']) . '</td>
                        <td>' . htmlspecialchars($table['user_id']) . '</td>
                        <td>' . htmlspecialchars($table['first_name'] . ' ' . $table['last_name']) . '</td>
                        <td>' . htmlspecialchars($table['email']) . '</td>
                        <td>' . htmlspecialchars($table['phone']) . '</td>
                        <td>' . htmlspecialchars($table['booking_date']) . '</td>
                        <td>' . htmlspecialchars($table['booking_time']) . '</td>
                        <td>' . htmlspecialchars($table['created_at']) . '</td>
                        <td>' . (isset($table['is_occupied']) && $table['is_occupied'] ? 'Occupied' : 'Available') . '</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="openDeleteModal(
                                \''. addslashes($table['booking_id']) .'\',
                                \''. addslashes($table['table_number']) .'\',
                                \''. addslashes($table['user_id']) .'\',
                                \''. addslashes($table['first_name']) .'\',
                                \''. addslashes($table['email']) .'\',
                                \''. addslashes($table['phone']) .'\',
                                \''. addslashes($table['booking_date']) .'\',
                                \''. addslashes($table['booking_time']) .'\',
                                \''. addslashes($table['created_at']) .'\'
                            )">Delete</button>
                        </td>
                    </tr>';
                }
                        }
                    echo '</tbody>
                    </table>';
                } catch (Exception $e) {
                    echo "<p>Error fetching booked tables: " . $e->getMessage() . "</p>";
                }
}

                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
