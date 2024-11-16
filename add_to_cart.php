<?php
session_start();
require_once 'mainDB.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = $_POST['menu_id'];
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];
    $quantity = 1;

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

    // Calculate total cost
    $total_cost = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_cost += $item['price'] * $item['quantity'];
    }
    $_SESSION['total_cost'] = $total_cost;

    echo json_encode(['total_cost' => $total_cost]);

    if (isset($_POST['menus'])) {
        $user_id = $_POST['user_id'];
        $menu_name = $_POST['menu_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];

        $checkMenuName = "SELECT * FROM menus WHERE menu_name = ?";
        $stmt = $conn->prepare($checkMenuName);
        $stmt->bind_param("s", $menu_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<h1>Item already exists!</h1>';
        } else {
            $insertQuery = "INSERT INTO menus (user_id, menu_name, description, price, category, quantity, created_at, updated_at)
                            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("issdsi", $user_id, $menu_name, $description, $price, $category, $quantity);

            if ($stmt->execute()) {
                header("Location: menu.php");
                exit();
            } else {
                echo 'Error: ' . $stmt->error;
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>
