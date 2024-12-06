<?php
session_start();
require_once '../DATABASE/mainDB.php';

class Cart {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function addToCart($menu_id, $menu_name, $price, $quantity) {
        $conn = $this->db->getConnection();
    
        // Check stock availability
        $checkStockQuery = "SELECT stock, category FROM inventory WHERE id = ?";
        $stmt = $conn->prepare($checkStockQuery);
        $stmt->bind_param("i", $menu_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $menu = $result->fetch_assoc();
    
        if (!$menu) {
            error_log("Menu ID $menu_id not found in inventory.");
            return "Item not found in inventory.";
        }
    
        error_log("Processing item: {$menu['category']} - {$menu_name} - Stock: {$menu['stock']}");
    
        if ($menu['stock'] < $quantity) {
            return "Insufficient stock for this item.";
        }
    
        // Deduct stock
    $newStock = $menu['stock'] - $quantity;
    $updateStockQuery = "UPDATE inventory SET stock = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateStockQuery);
    $updateStmt->bind_param("ii", $newStock, $menu_id);

    if ($updateStmt->execute()) {
        error_log("Stock updated for Menu ID $menu_id. New stock: $newStock");
    } else {
        error_log("Failed to update stock for Menu ID $menu_id. Error: " . $updateStmt->error);
        return "Failed to update stock.";
    }

    // Add to cart logic (same as before)
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

    public function addMenu($menu_name, $price, $quantity) {
        $conn = $this->db->getConnection();

        // Insert new menu item
        $insertQuery = "INSERT INTO menusbenta (menu_name, price, quantity) 
                        VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sdi", $menu_name, $price, $quantity);

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
        $quantity = $_POST['quantity'];

        $total_cost = $cart->addToCart($menu_id, $menu_name, $price, $quantity);

        echo json_encode(['total_cost' => $total_cost]);
    }

    if (isset($_POST['menus'])) {
        $menu_name = $_POST['menu_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $result = $cart->addMenu($menu_name, $price, $quantity);

        if ($result === true) {
            header("Location: ../MENU/menu.php");
            exit();
        } else {
            echo "<h1>$result</h1>";
        }
    }
}
?>