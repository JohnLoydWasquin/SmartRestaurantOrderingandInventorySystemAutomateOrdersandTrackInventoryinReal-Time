<?php
require_once '../DATABASE/mainDB.php';
require_once '../ADMIN/dashboard_panel.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];

        if ($inventoryItems->updateItems($id, $name, $category, $stock, $price)) {
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
                window.location.href = '../ADMIN/inventory_function.php?page=inventory';
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