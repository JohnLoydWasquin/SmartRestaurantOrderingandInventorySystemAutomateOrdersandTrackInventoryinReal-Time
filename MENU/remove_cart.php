<?php
session_start();
require '../MENU/Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = new Cart();

    $index = intval($_POST['index']);

    if ($cart->removeItem($index)) {
        header('Location: ../MENU/cartTable.php?message=Item removed successfully');
    } else {
        header('Location: ../MENU/cartTable.php?message=Failed to remove item');
    }
    exit;
}
?>
