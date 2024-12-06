<?php
require_once '../DATABASE/mainDB.php';
class BookTable {

    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection(); 
    }

    // Add a new table to the restaurant
    public function addTable($tableName, $reservedBy, $reservedDate, $status) {
        $sql = "INSERT INTO restaurant_tables (table_name, reserved_by, reserved_date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $tableName, $reservedBy, $reservedDate, $status);

        return $stmt->execute();
    }

    // Update an existing table
    public function updateTable($id, $tableName, $reservedBy, $reservedDate, $status) {
        $sql = "UPDATE restaurant_tables SET table_name = ?, reserved_by = ?, reserved_date = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $tableName, $reservedBy, $reservedDate, $status, $id);

        return $stmt->execute();
    }

    // Delete a table
    public function deleteTable($tableId) {
        $sql = "DELETE FROM restaurant_tables WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $tableId);

        return $stmt->execute();
    }

    // Get all booked tables
    public function getBookTable() {
        $sql = "SELECT * FROM restaurant_tables WHERE status = 'Reserved' OR status = 'Occupied'";  // Fetch only the booked tables
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $tables = [];
            while ($row = $result->fetch_assoc()) {
                $tables[] = $row;
            }
            return $tables;  // Return an array of booked tables
        } else {
            return [];  // Return an empty array if no booked tables are found
        }
    }
}
?>
