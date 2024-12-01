<?php
session_start();
require_once '../DATABASE/mainDB.php';

class Cart {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function addToCart($menu_id, $menu_name, $price, $quantity = 1) {
        $conn = $this->db->getConnection();
    
        // Check stock availability
        $checkStockQuery = "SELECT stock FROM inventory WHERE id = ?";
        $stmt = $conn->prepare($checkStockQuery);
        $stmt->bind_param("i", $menu_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $menu = $result->fetch_assoc();
    
        if (!$menu) {
            return "Item not found in inventory.";
        }
    
        if ($menu['stock'] < $quantity) {
            return "Insufficient stock for this item.";
        }
    
        // Add to session cart
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['menu_id'] == $menu_id) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
    
        if (!$found) {
            $_SESSION['cart'][] = [
                'menu_id' => $menu_id,
                'menu_name' => $menu_name,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }
    
        // Deduct stock from the database
        $newStock = $menu['stock'] - $quantity;
        $updateStockQuery = "UPDATE inventory SET stock = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateStockQuery);
        $updateStmt->bind_param("ii", $newStock, $menu_id);
    
        if ($updateStmt->execute()) {
            return $this->calculateTotalCost();
        } else {
            return "Failed to update stock.";
        }
    }
    

    public function calculateTotalCost() {
        $total_cost = 0;
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total_cost += $item['price'] * $item['quantity'];
            }
        }
        $_SESSION['total_cost'] = $total_cost;
        return $total_cost;
    }

    public function addMenu($user_id, $menu_name, $description, $price, $category, $quantity) {
        $conn = $this->db->getConnection();

        // Check if the menu item already exists
        $checkMenuName = "SELECT * FROM menus WHERE menu_name = ?";
        $stmt = $conn->prepare($checkMenuName);
        $stmt->bind_param("s", $menu_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "Item already exists!";
        }

        // Insert new menu item
        $insertQuery = "INSERT INTO menus (user_id, menu_name, description, price, category, quantity, created_at, updated_at) 
                        VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("issdsi", $user_id, $menu_name, $description, $price, $category, $quantity);

        if ($stmt->execute()) {
            return true; // Menu added successfully
        } else {
            return "Error: " . $stmt->error;
        }
    }
}

// Initialize the database and cart objects
$db = new Database();
$cart = new Cart($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['menu_id'], $_POST['menu_name'], $_POST['price'])) {
        $menu_id = $_POST['menu_id'];
        $menu_name = $_POST['menu_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'] ?? 1;

        $total_cost = $cart->addToCart($menu_id, $menu_name, $price, $quantity);

        echo json_encode(['total_cost' => $total_cost]);
    }

    if (isset($_POST['menus'])) {
        $user_id = $_POST['user_id'];
        $menu_name = $_POST['menu_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];

        $result = $cart->addMenu($user_id, $menu_name, $description, $price, $category, $quantity);

        if ($result === true) {
            header("Location: ../MENU/menu.php");
            exit();
        } else {
            echo "<h1>$result</h1>";
        }
    }
}
?>
