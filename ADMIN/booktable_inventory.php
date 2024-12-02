<<?php
require_once '../DATABASE/mainDB.php'; 
require_once '../ADMIN/dashboard_function.php'; 
require_once '../MAIN/booktableM.php';


$dashboardFunctions = new DashboardFunctions();
$bookTableInventory = $dashboardFunctions->getBookTableInventory(); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? ''; 
    $bookTable = new BookTable(); 

    // Add Table
    if ($action === 'add') {
        $tableName = isset($_POST['table_name']) ? $_POST['table_name'] : '';
        $reservedBy = isset($_POST['reserved_by']) ? $_POST['reserved_by'] : '';
        $reservedDate = isset($_POST['reserved_date']) ? $_POST['reserved_date'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : 'Available'; // Default to 'Available' if no status is selected

        if ($bookTable->addTable($tableName, $reservedBy, $reservedDate, $status)) {
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Table added successfully!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'booktable_inventory.php';
                    }
                });
            </script>";
        } else {
            echo "<script>alert('Error adding table.');</script>";
        }
    }
    // Update Table
    elseif ($action === 'update') {
        $id = $_POST['id'] ?? '';
        $tableName = isset($_POST['table_name']) ? $_POST['table_name'] : '';
        $reservedBy = isset($_POST['reserved_by']) ? $_POST['reserved_by'] : '';
        $reservedDate = isset($_POST['reserved_date']) ? $_POST['reserved_date'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        if ($bookTable->updateTable($id, $tableName, $reservedBy, $reservedDate, $status)) {
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Table updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'booktable_inventory.php';
                    }
                });
            </script>";
        } else {
            echo "<script>alert('Error updating table.');</script>";
        }
    }
    // Delete Table
    elseif ($action === 'delete') {
        $tableId = $_POST['table_id'] ?? '';

        if (empty($tableId)) {
            echo "<script>alert('Error: table_id is missing.');</script>";
            exit;
        }

        if ($bookTable->deleteTable($tableId)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Table has been deleted successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'booktable_inventory.php';
                });
            </script>";
        } else {
            echo "<script>alert('Error deleting table.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Table Inventory</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Book Table Inventory</h1>

        <!-- Display booked tables -->
        <?php if (count($bookTableInventory) > 0): ?>
            <h3 class="mt-4">Booked Tables</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Table Name</th>
                        <th>Status</th>
                        <th>Reserved By</th>
                        <th>Reservation Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookTableInventory as $table): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($table['table_name']); ?></td>
                            <td><?php echo htmlspecialchars($table['status']); ?></td>
                            <td><?php echo htmlspecialchars($table['reserved_by']); ?></td>
                            <td><?php echo htmlspecialchars($table['reserved_date']); ?></td>
                            <td>
                                <!-- Add Edit and Delete buttons -->
                                <form action="booktable_inventory.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<?php echo $table['id']; ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                </form>
                                <form action="booktable_inventory.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="table_id" value="<?php echo $table['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No booked tables found.</p>
        <?php endif; ?>

        <!-- Form to add new table -->
        <h3 class="mt-4">Add a New Table</h3>
        <form action="booktable_inventory.php" method="POST">
            <input type="hidden" name="action" value="add">
            
            <div class="mb-3">
                <label for="table_name" class="form-label">Table Name:</label>
                <input type="text" id="table_name" name="table_name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="reserved_by" class="form-label">Reserved By:</label>
                <input type="text" id="reserved_by" name="reserved_by" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="reserved_date" class="form-label">Reserved Date:</label>
                <input type="datetime-local" id="reserved_date" name="reserved_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-select">
                    <option value="Available">Available</option>
                    <option value="Reserved">Reserved</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Table</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
