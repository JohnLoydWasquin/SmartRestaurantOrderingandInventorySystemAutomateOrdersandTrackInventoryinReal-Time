<?php
require_once '../DATABASE/mainDB.php';
require_once '../ADMIN/dashboard_panel.php';

$inventoryManager = new InventoryManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        try {
            $itemName = $_POST['item_name'];
            $category = $_POST['category'];
            $stock = $_POST['stock'];
            $price = $_POST['price'];

            $inventoryManager->addItem($itemName, $category, $stock, $price);

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
                    icon: 'success',
                    title: 'Item added successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '../ADMIN/dashboard_panel.php?page=inventory';
                });
        </script>
        </body>
        </html>";
        } catch (Exception $e) {
            echo "<script>alert('Error updating user.');</script>";
        }
    }
}
