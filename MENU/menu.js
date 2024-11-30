let totalAmount = 0;

function addToCart(price) {
    totalAmount += price;
    
    document.querySelector('.basket-btn').innerHTML = `Basket <i>•</i> ₱${totalAmount}`;
}

document.querySelectorAll('.add-to-cart').forEach((button, index) => {
    button.addEventListener('click', () => {
        const priceText = button.nextElementSibling.innerText.replace('₱', '');
        const price = parseFloat(priceText);
        
        addToCart(price);
    });
});
