// Function to display the order summary
function displayOrderSummary() {
    // Retrieve cart items from localStorage
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Calculate subtotal and total
    let cartSubtotal = 0;
    const orderSummaryContainer = document.querySelector('.order-summary');
    orderSummaryContainer.innerHTML = ''; // Clear any existing content

    cartItems.forEach(item => {
        const itemSubtotal = item.price * item.quantity;
        cartSubtotal += itemSubtotal;

        // Create item details
        const itemDetails = `
            <div class="item">
                <p><strong>Image:</strong> <img src="${item.image}" alt="${item.name}" style="width: 70px;"></p>
                <p><strong>Item Name:</strong> ${item.name}</p>
                <p><strong>Item ID:</strong> ${item.id}</p>
                <p><strong>Quantity:</strong> ${item.quantity}</p>
                <p><strong>Size:</strong> ${item.size}</p>
            </div>
        `;

        // Append item details to the container
        orderSummaryContainer.innerHTML += itemDetails;
    });

    const shippingFee = 38;
    const cartTotal = cartSubtotal + shippingFee;

    // Create order summary details
    const orderDetails = `
        <p><strong>Subtotal:</strong> ₱${cartSubtotal.toFixed(2)}</p>
        <p><strong>Shipping:</strong> ₱${shippingFee.toFixed(2)}</p>
        <p><strong>Total:</strong> ₱${cartTotal.toFixed(2)}</p>
    `;

    // Append the order details to the container
    orderSummaryContainer.innerHTML += orderDetails;

    // Set hidden form fields
    document.getElementById('total').value = cartTotal;
    document.getElementById('cartItems').value = JSON.stringify(cartItems);
}


// Function to handle order confirmation
function confirmOrder(event) {
    event.preventDefault();

    // Display the order confirmation modal
    const modal = document.getElementById('order-confirmation-modal');
    modal.style.display = 'block';

    // Retrieve cart items and total
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const total = document.getElementById('total').value;

    // Ensure image data is included
 

// Invoke the function to display the order summary when the page loads
document.addEventListener('DOMContentLoaded', function() {
    displayOrderSummary();

    // Add event listener for the confirm order button
    document.getElementById('confirm-order-btn').addEventListener('click', confirmOrder);
});
    
    function loadProfile() {
            
            var email = localStorage.getItem('email');
            var username = localStorage.getItem('username');
            var address = localStorage.getItem('address');
            var contact = localStorage.getItem('contact');

            
            document.getElementById('email').innerText = email ? email : 'N/A';
            document.getElementById('username').innerText = username ? username : 'N/A';
            document.getElementById('address').innerText = address ? address : 'N/A';
            document.getElementById('contact').innerText = contact ? contact : 'N/A';
        }

        document.addEventListener('DOMContentLoaded', loadProfile);

function placeOrder() {
    // Simulate placing an order and then clear the cart
    alert('Order placed successfully!');
    
    window.location.href = 'home.html';
}
