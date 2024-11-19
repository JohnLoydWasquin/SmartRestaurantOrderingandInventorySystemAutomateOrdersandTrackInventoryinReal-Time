<?php
session_start();
require 'Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = new Cart();

    $index = intval($_POST['index']);
    $quantity = intval($_POST['quantity']);

    if ($cart->updateItem($index, $quantity)) {
        header('Location: cartTable.php?message=Item updated successfully');
    } else {
        header('Location: cartTable.php?message=Failed to update item');
    }
    exit;
}
?>
