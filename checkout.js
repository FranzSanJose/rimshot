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
    fetch('checkout.html', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `total=${total}&cartItems=${encodeURIComponent(JSON.stringify(cartItems))}&submit_order=1`,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Debugging: Print server response

        // Clear cart items from localStorage
        localStorage.removeItem('cartItems');

        // Redirect to the homepage or any other page
        window.location.href = 'home.html';
    })
    .catch(error => {
        console.error('Error:', error);

        // Redirect to the homepage or any other page even if there's an error
        window.location.href = 'home.html';
    });
}

// Invoke the function to display the order summary when the page loads
document.addEventListener('DOMContentLoaded', function() {
    displayOrderSummary();

    // Add event listener for the confirm order button
    document.getElementById('confirm-order-btn').addEventListener('click', confirmOrder);
});
