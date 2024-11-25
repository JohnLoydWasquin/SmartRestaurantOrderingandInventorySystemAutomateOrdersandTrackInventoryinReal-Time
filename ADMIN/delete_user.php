<?php
session_start();
require_once '../DATABASE/mainDB.php';

if(isset($_POST['user_id'])){
    $userId = intval($_POST['user_id']);

    $query = "DELETE FROM users WHERE user_id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);

    if($stmt->execute()){
        echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
    }else{
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user']);
    }

    $stmt->close();
    $conn->close();
}
