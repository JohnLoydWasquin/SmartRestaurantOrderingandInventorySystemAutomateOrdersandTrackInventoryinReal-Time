<?php
require_once '../DATABASE/mainDB.php';
require_once '../ADMIN/dashboard_panel.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

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
    } elseif ($action === 'delete') {
        $userId = $_POST['user_id'];

        if (empty($userId)) {
            echo "<script>alert('Error: user_id is missing.');</script>";
            exit;
        }

        if ($userAdmin->deleteUser($userId)) {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>SweetAlert</title>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
                <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'User has been deleted successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '../ADMIN/update_delete.php?page=users';
                });
                </script>
                </body>
                </html>";
        } else {
            echo "<script>alert('Error deleting user.');</script>";
        }
    }
}
