<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'Cart.php';

$cart = new Cart();
$cart_items = $cart->getCartItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <!-- Include Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Your Cart</h1>

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
                        <form action="remove_cart.php" method="POST" style="display: inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2">₱<?php echo number_format($grand_total, 2); ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Your cart is empty.</p>
    <?php endif; ?>

    <div class="text-center">
        <a href="menu.php" class="btn btn-secondary">Back to Menu</a>
        <a href="basketOrder.php" class="btn btn-success" id="checkoutBtn">Checkout</a>
    </div>
</div>
<script>
    document.getElementById('checkoutBtn').addEventListener('click', function (event) {
        const isCartEmpty = <?php echo empty($cart_items) ? 'true' : 'false'; ?>;

        if (isCartEmpty) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Your cart is empty',
                text: 'Please add some items to your cart before checking out.',
                confirmButtonText: 'OK'
            });
        } else {
            window.location.href = 'basketOrder.php';
        }
    });
</script>
</body>
</html>
