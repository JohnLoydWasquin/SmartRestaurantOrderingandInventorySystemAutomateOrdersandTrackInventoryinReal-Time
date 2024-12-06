<?php
require_once '../DATABASE/mainDB.php';

class InventoryManager {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Retrieve all inventory items
    public function getAllItems() {
        $query = "SELECT id, name, category, stock, price FROM inventory";
        $result = $this->conn->query($query);

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        return $items;
    }

    public function addItem($name, $category, $stock, $price) {
        $query = "INSERT INTO inventory (name, category, stock, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdi", $name, $category, $stock, $price);
        if (!$stmt->execute()) {
            throw new Exception("Error adding item: " . $stmt->error);
        }
        return true;
    }
    
    // Update an existing item
    public function updateItems($id, $name, $category, $stock, $price) {
        try {
            $query = "UPDATE inventory SET name = ?, category = ?, stock = ?, price = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Error preparing query: " . $this->conn->error);
            }
    
            // Correct parameter types to match the query (ssidi)
            $stmt->bind_param("ssidi", $name, $category, $stock, $price, $id);
        
            if (!$stmt->execute()) {
                throw new Exception("Error executing query: " . $stmt->error);
            }
        
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteItems($id) {
        $query = "DELETE FROM inventory WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting item: " . $stmt->error);
        }
        return true;
    }
}
