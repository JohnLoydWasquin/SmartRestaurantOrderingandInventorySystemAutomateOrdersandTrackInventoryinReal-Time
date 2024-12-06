<?php
require_once '../DATABASE/mainDB.php';
require_once '../ADMIN/dashboard_panel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Handle Update action for Users
    if ($action === 'update') {
        $userId = $_POST['user_id'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        if ($userAdmin->updateUser($userId, $firstName, $email, $role)) {
            echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Success!',
            text: 'User updated successfully!',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../ADMIN/update_delete.php?page=users';
            }
        });
        </script>
        </body>
        </html>";
        } else {
            echo "<script>alert('Error updating user.');</script>";
        }
    }
    // Handle Delete action for Users
    elseif ($action === 'delete' && isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];

        if (empty($userId)) {
            echo json_encode(['status' => 'error', 'message' => 'Error: user_id is missing.']);
            exit;
        }

        if ($userAdmin->deleteUser($userId)) {
            echo json_encode(['status' => 'success', 'message' => 'User has been deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting user.']);
        }
    }
    // Handle Delete action for Bookings (BookTable)
    elseif ($action === 'delete' && isset($_POST['booking_id'])) {
        $bookingId = $_POST['booking_id'];

        if (empty($bookingId)) {
            echo json_encode(['status' => 'error', 'message' => 'Error: booking_id is missing.']);
            exit;
        }

        // Initialize database connection
        $db = new Database();
        $conn = $db->getConnection();

        // Prepare delete query for booking
        $query = "DELETE FROM bookings WHERE booking_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('i', $bookingId); 
            
            // Execute query
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Booking has been deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error deleting booking.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error preparing query.']);
        }
    }
}
?>
