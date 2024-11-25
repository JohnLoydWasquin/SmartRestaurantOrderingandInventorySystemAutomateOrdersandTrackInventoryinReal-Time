<?php
session_start();
require_once '../DATABASE/mainDB.php';

if (isset($_POST['user_id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['role'])) {
    $userId = intval($_POST['user_id']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $query = "UPDATE users SET firstName = ?, email = ?, role = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssi', $name, $email, $role, $userId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating user']);
    }

    $stmt->close();
    $conn->close();
}
?>
