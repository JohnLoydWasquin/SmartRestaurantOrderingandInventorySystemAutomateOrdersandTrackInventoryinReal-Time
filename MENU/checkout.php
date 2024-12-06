<?php
session_start();
include '../DATABASE/mainDB.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$totalAmount = 0;
foreach ($cart as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

$customerName = $_SESSION['firstName'] ?? 'Unknown';
$tableNumber = $_POST['table_number'] ?? 'N/A';
$paymentMethod = $_POST['payment_method'] ?? 'Cash';
$orderNumber = rand(1000, 9999);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="websiteImage/LogoFP.webp">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <link rel="icon" type="image/x-icon" href="../websiteImage/LogoFP.webp">
    <title>Receipt</title>
    <style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-align: center;
        margin: 20px;
        margin-top: 50px;
        background-color: rgb(248, 232, 217);
    }
    .receipt {
        border: 1px solid #000;
        box-shadow: 0 10px 15px rgb(250, 120, 69);
        padding: 20px;
        width: 300px;
        margin: 0 auto;
        text-align: left;
    }
    .receipt-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .receipt-header h1 {
        margin: 0;
    }
    .receipt-item {
        display: flex;
        justify-content: space-between;
    }
    .receipt-total {
        font-weight: bold;
        margin-top: 20px;
    }
</style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <h1>Samgyup Paradise</h1>
            <p>Order #: <?php echo $orderNumber; ?></p>
            <p>Date: <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>

        <p>Customer Name: <?php echo htmlspecialchars($customerName); ?></p>

        <h2>Order Summary</h2>
        <?php foreach ($cart as $item): ?>
        <div class="receipt-item">
            <span><?php echo htmlspecialchars($item['menu_name']); ?> x<?php echo $item['quantity']; ?></span>
            <span>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
        </div>
        <?php endforeach; ?>
        <div class="receipt-total">
            <span>Total:</span>
            <span>₱<?php echo number_format($totalAmount, 2); ?></span>
        </div>

        <p>Payment Method: <?php echo htmlspecialchars($paymentMethod); ?></p>
        <p>Thank you for dining with us!</p>
    </div>
</body>
</html>
<?php
// Clear the cart after displaying the receipt
unset($_SESSION['cart']);
?>
