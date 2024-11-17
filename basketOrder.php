<?php
session_start();

// Ensure the cart session variable is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart_items = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Samgyup Paradise</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Your Cart Nigga</h1>
    <?php if (!empty($cart_items)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                foreach ($cart_items as $index => $item): 
                    $total = $item['price'] * $item['quantity'];
                    $grand_total += $total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['menu_name']); ?></td>
                    <td>₱<?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <form action="update_cart.php" method="POST" style="display: inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 60px;">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                    <td>₱<?php echo number_format($total, 2); ?></td>
                    <td>
                        <form action="remove_from_cart.php" method="POST" style="display: inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                    <td colspan="2">₱<?php echo number_format($grand_total, 2); ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Your cart is empty.</p>
    <?php endif; ?>
    <div class="text-center">
        <a href="menu.php" class="btn btn-secondary">Back to Menu</a>
        <a href="checkout.php" class="btn btn-success">Checkout</a>
    </div>
</div>
</body>
</html>
