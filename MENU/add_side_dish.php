<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_id = $_POST['menu_id'] ?? null;
    $menu_name = $_POST['menu_name'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;

    if (!isset($_SESSION['side_dishes'])) {
        $_SESSION['side_dishes'] = [];
    }

    if ($menu_id && $menu_name) {
        $_SESSION['side_dishes'][] = [
            'menu_id' => $menu_id,
            'menu_name' => $menu_name,
            'quantity' => $quantity
        ];
    }
    header('Location: sideDishes.php');
    exit();
}
?>
