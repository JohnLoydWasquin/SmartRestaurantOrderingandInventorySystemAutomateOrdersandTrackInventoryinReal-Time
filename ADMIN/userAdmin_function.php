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
}
