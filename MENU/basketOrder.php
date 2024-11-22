<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../DATABASE/mainDB.php';
require '../MENU/Cart.php';
require '../LOGIN/login.php';

if (!isset($_SESSION['user_id'])) {
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Login Required',
            text: 'You must log in before placing an order.',
            icon: 'error',
            confirmButtonText: 'Okay'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../LOGIN/login.html';
            }
        });
        </script>
        </body>
        </html>";
    exit;
}

$cart = new Cart();
$cart_items = $cart->getCartItems();

// Ensure cart is not empty
if (empty($cart_items)) {
    echo "Your cart is empty.";
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id'];
$grand_total = 0;

// Prepare SQL for inserting orders
$insertOrderQuery = "INSERT INTO menusbenta (user_id, menu_id, menu_name, price, quantity, total) VALUES (?, ?, ?, ?, ?, ?)ON DUPLICATE KEY UPDATE 
    quantity = quantity + VALUES(quantity),
    total = total + VALUES(total)";
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

// Confirmation message and redirect
header('Location: ../MENU/checkout.php');
exit;
?>