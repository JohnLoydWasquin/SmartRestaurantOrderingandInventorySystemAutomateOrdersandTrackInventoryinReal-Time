<?php
session_start();
require '../DATABASE/mainDB.php'; // Include your database connection
require '../MENU/Cart.php';
require '../MENU/ordersDBConn.php';

if (!isset($_SESSION['user_id'])) {
    echo "Error: You must log in before placing an order.";
    exit;
}

$cart = new Cart();
$cart_items = $cart->getCartItems();

// Ensure cart is not empty
if (empty($cart_items)) {
    echo "Your cart is empty.";
    exit;
}

// Database connection
$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id']; // Logged-in user's ID
$grand_total = 0;

// Prepare SQL for inserting orders
$insertOrderQuery = "INSERT INTO Orders (user_id, menu_id, menu_name, price, quantity, total) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertOrderQuery);

// Insert each cart item into the Orders table
foreach ($cart_items as $item) {
    $menu_id = $item['menu_id'];
    $menu_name = $item['menu_name'];
    $price = $item['price'];
    $quantity = $item['quantity'];
    $total = $price * $quantity;

    // Add the total to the grand total
    $grand_total += $total;

    // Bind parameters and execute the query
    $stmt->bind_param("iisdid", $user_id, $menu_id, $menu_name, $price, $quantity, $total);
    $stmt->execute();
}

// Clear the cart after placing the order
$_SESSION['cart'] = [];

// Confirmation message and redirect
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
