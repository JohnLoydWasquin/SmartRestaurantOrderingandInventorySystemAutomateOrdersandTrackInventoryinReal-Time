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

    // Add a new item to the inventory
    // public function addItem($id, $name, $category, $stock, $price) {
    //     $this->inventoryItems[] = [
    //         'id' => $id,
    //         'name' => $name,
    //         'category' => $category,
    //         'stock' => $stock,
    //         'price' => $price
    //     ];
    // }

    // Update an existing item
    public function updateItems($id, $name, $category, $stock, $price) {
        $query = "UPDATE inventory SET name = ?, category = ?, stock = ?, price = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$name, $category, $stock, $price, $id]);
    }
    

    // // Delete an item from the inventory
    // public function deleteItem($id) {
    //     foreach ($this->inventoryItems as $key => $item) {
    //         if ($item['id'] == $id) {
    //             unset($this->inventoryItems[$key]);
    //             $this->inventoryItems = array_values($this->inventoryItems); // Re-index array
    //             return true; // Item deleted
    //         }
    //     }
    //     return false; // Item not found
    // }
}
