<?php
session_start();
require 'Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = new Cart();

    $index = intval($_POST['index']);

    if ($cart->removeItem($index)) {
        header('Location: cartTable.php?message=Item removed successfully');
    } else {
        header('Location: cartTable.php?message=Failed to remove item');
    }
    exit;
}
?>
