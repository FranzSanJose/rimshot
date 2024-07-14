document.getElementById('add-to-cart-btn').addEventListener('click', function() {
    var selectedSize = document.getElementById('sizeSelect').value;
    var selectedQuantity = parseInt(document.getElementById('quantityInput').value); // Get selected quantity

    if (selectedSize !== '' && selectedQuantity > 0) {
        // Create an object representing the product
        var productId = ''; // Initialize product ID variable

        // Generate unique product ID based on size
        switch (selectedSize) {
            case 'Small':
                productId = '115632';
                break;
            case 'Medium':
                productId = '127845';
                break;
            case 'Large':
                productId = '134563';
                break;
            case 'XL':
                productId = '149856';
                break;
            default:
                productId = ''; // Default to empty string if size is not recognized
        }

        var product = {
            id: productId, // Unique ID for the product based on size
            name: 'I ll ball ti l the day i fall',
            image: 'product1.png',
            price: 400,
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
        window.location.href = 'cart.php';
    } else {
        alert('Please select a size before adding to cart.');
    }
});
