<?php
require_once '../DATABASE/mainDB.php';
require_once '../ADMIN/dashboard_panel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        // Add new item logic
        $itemName = $_POST['item_name'];
        $category = $_POST['category'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("INSERT INTO inventory (name, category, stock, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $itemName, $category, $stock, $price);
        if ($stmt->execute()) {
            echo "Item added successfully!";
        } else {
            echo "Error adding item.";
        }
    } elseif ($action === 'update') {
        // Update item logic
        $itemId = $_POST['item_id'];
        $itemName = $_POST['item_name'];
        $category = $_POST['category'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE inventory SET name = ?, category = ?, stock = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssdii", $itemName, $category, $stock, $price, $itemId);
        if ($stmt->execute()) {
            echo "Item updated successfully!";
        } else {
            echo "Error updating item.";
        }
    }
}
?>
