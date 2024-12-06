<?php
require_once '../DATABASE/mainDB.php';
require_once '../ADMIN/dashboard_panel.php';
require_once '../ADMIN/inventoryManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update') {
        $itemId = $_POST['item_id']; // Replace user_id with id for inventory
        $name = $_POST['item_name'];
        $category = $_POST['category'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];

        $inventoryManager = new InventoryManager();
        // Call the update method
        if ($inventoryItems->updateItems($itemId, $name, $category, $stock, $price)) {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Success</title>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
            <script>
            Swal.fire({
                title: 'Success!',
                text: 'Item updated successfully!',
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
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Error</title>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
            <script>
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update item. Please try again later.',
                icon: 'error',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
            </script>
            </body>
            </html>";
        }
    } elseif ($action === 'delete') {
        $itemId = $_POST['id'];

        if (empty($itemId)) {
            echo json_encode(['status' => 'error', 'message' => 'Error: Item ID is missing.']);
            exit;
        }

        if ($inventoryItems->deleteItems($itemId)) {
            echo json_encode(['status' => 'success', 'message' => 'Item has been deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting item.']);
        }
    }elseif ($action === 'delete'){
        $booking_id = $_POST['booking_id'];

        if (empty($itemId)) {
            echo json_encode(['status' => 'error', 'message' => 'Error: Item ID is missing.']);
            exit;
        }

        if ($inventoryItems->deleteBooking($booking_id)) {
            echo json_encode(['status' => 'success', 'message' => 'Item has been deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting item.']);
        }
    }
}
