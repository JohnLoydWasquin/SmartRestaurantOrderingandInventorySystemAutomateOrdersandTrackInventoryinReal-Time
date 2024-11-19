<?php
class Cart {
    private $cartItems;

    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->cartItems = &$_SESSION['cart'];
    }

    // Update the quantity of an item
    public function updateItem($index, $quantity) {
        if (isset($this->cartItems[$index]) && $quantity > 0) {
            $this->cartItems[$index]['quantity'] = $quantity;
            return true;
        }
        return false;
    }

    // Remove an item from the cart
    public function removeItem($index) {
        if (isset($this->cartItems[$index])) {
            unset($this->cartItems[$index]);
            // Re-index the cart to maintain array consistency
            $this->cartItems = array_values($this->cartItems);
            return true;
        }
        return false;
    }

    // Get all cart items
    public function getCartItems() {
        return $this->cartItems;
    }
}
?>
