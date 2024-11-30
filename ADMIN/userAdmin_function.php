<?php 
require_once '../DATABASE/mainDB.php';

class UserAdminFunction{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllUsers(){
        $query = "SELECT user_id, firstName, email, role FROM users";
        $result = $this->conn->query($query);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function updateUser($userId, $firstName, $email, $role) {
        $query = "UPDATE users SET firstName = ?, email = ?, role = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $firstName, $email, $role, $userId);
        if (!$stmt->execute()) {
            throw new Exception("Error updating user: " . $stmt->error);
        }
        return true;
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting user: " . $stmt->error);
        }
        return true;
    }
}
