<?php
require_once '../DATABASE/mainDB.php';
require_once '../ADMIN/userAdmin_function.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['userId'];

    $userAdmin = new UserAdminFunction();
    $result = $userAdmin->deleteUser($userId);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
