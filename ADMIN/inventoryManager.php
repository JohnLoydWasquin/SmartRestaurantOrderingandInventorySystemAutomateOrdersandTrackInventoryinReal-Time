<?php
class InventoryManager {
    private $inventoryItems = [];

    public function __construct($items = []) {
        $this->inventoryItems = $items;
    }

    // Retrieve all inventory items
    public function getAllItems() {
        return $this->inventoryItems;
    }

    // Add a new item to the inventory
    public function addItem($id, $name, $category, $stock, $price) {
        $this->inventoryItems[] = [
            'id' => $id,
            'name' => $name,
            'category' => $category,
            'stock' => $stock,
            'price' => $price
        ];
    }

    // Update an existing item
    public function updateItem($id, $name, $category, $stock, $price) {
        foreach ($this->inventoryItems as &$item) {
            if ($item['id'] == $id) {
                $item['name'] = $name;
                $item['category'] = $category;
                $item['stock'] = $stock;
                $item['price'] = $price;
                return true; // Item updated
            }
        }
        return false; // Item not found
    }

    // Delete an item from the inventory
    public function deleteItem($id) {
        foreach ($this->inventoryItems as $key => $item) {
            if ($item['id'] == $id) {
                unset($this->inventoryItems[$key]);
                $this->inventoryItems = array_values($this->inventoryItems); // Re-index array
                return true; // Item deleted
            }
        }
        return false; // Item not found
    }
}
