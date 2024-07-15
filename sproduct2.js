document.getElementById('add-to-cart-btn').addEventListener('click', function() {
    var selectedSize = document.getElementById('sizeSelect').value;
    var selectedQuantity = parseInt(document.getElementById('quantityInput').value); // Get selected quantity

    if (selectedSize !== '' && selectedQuantity > 0) {
        // Create an object representing the product
        var productId = ''; // Initialize product ID variable

        // Generate unique product ID based on size
        switch (selectedSize) {
            case 'Small':
                productId = '219632';
                break;
            case 'Medium':
                productId = '227412';
                break;
            case 'Large':
                productId = '236547';
                break;
            case 'XL':
                productId = '248529';
                break;
            default:
                productId = ''; // Default to empty string if size is not recognized
        }

        var product = {
            id: productId, // Unique ID for the product based on size
            name: 'Old School Ballers Vibes',
            price: 380,
            image: 'product2.png',
            size: selectedSize,
            quantity: selectedQuantity // Add selected quantity
        };

        // Get the existing cart items from localStorage or initialize an empty array
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        // Add the new product to the cart
        cartItems.push(product);

        // Store the updated cart items back to localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));

        // Redirect to cart.php after adding the item to the cart
        window.location.href = 'cart.html';
    } else {
        alert('Please select a size before adding to cart.');
    }
});
