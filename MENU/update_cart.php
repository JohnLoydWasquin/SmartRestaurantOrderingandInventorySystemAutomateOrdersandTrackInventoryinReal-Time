<?php
session_start();
require '../MENU/Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = new Cart();

    $index = intval($_POST['index']);
    $quantity = intval($_POST['quantity']);

    if ($cart->updateItem($index, $quantity)) {
        header('Location: ../MENU/cartTable.php?message=Item updated successfully');
    } else {
        header('Location: ../MENU/cartTable.php?message=Failed to update item');
    }
    exit;
}
?>
