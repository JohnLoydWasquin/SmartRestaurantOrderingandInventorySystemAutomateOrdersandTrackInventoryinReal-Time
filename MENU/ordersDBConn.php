<?php
session_start();
require '../DATABASE/mainDB.php';
require '../MENU/Cart.php';
require '../MENU/ordersDBConn.php';

if (!isset($_SESSION['user_id'])) {
    echo "Error: You must log in before placing an order.";
    exit;
}

$cart = new Cart();
$cart_items = $cart->getCartItems();

if (empty($cart_items)) {
    echo "Your cart is empty.";
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id'];
$grand_total = 0;

$insertOrderQuery = "INSERT INTO menusbenta (user_id, menu_id, menu_name, price, quantity, total) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertOrderQuery);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

foreach ($cart_items as $item) {
    $menu_id = $item['menu_id'];
    $menu_name = $item['menu_name'];
    $price = $item['price'];
    $quantity = $item['quantity'];
    $total = $price * $quantity;

    $grand_total += $total;

    $stmt->bind_param("iisddi", $user_id, $menu_id, $menu_name, $price, $quantity, $total);

    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
}

$_SESSION['cart'] = [];

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Order Confirmation</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
<script>
Swal.fire({
    title: 'Success!',
    text: 'Your order has been placed successfully!',
    icon: 'success',
    confirmButtonText: 'Okay'
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = '../MENU/menu.php';
    }
});
</script>
</body>
</html>";
exit;
?>
