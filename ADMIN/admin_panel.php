<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samgyup - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../ADMIN/admin.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Admin Dashboard</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0" data-page="dashboard">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle" data-page="users">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle" data-page="content">
                                <i class="fs-4 bi-file-earmark-text"></i> <span class="ms-1 d-none d-sm-inline">Content</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle" data-page="settings">
                                <i class="fs-4 bi-gear"></i> <span class="ms-1 d-none d-sm-inline">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Main content -->
            <div class="col py-3">
                <header class="pb-3 mb-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2">Welcome, Admin</h1>
                        <button class="btn btn-primary" id="toggle-sidebar">Toggle Sidebar</button>
                    </div>
                </header>
                <div id="content">
                    <!-- Content will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../ADMIN/admin.js"></script>
</body>
</html>

