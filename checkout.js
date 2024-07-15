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
    fetch('checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `total=${total}&cartItems=${encodeURIComponent(JSON.stringify(cartItems))}&submit_order=1`,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Debugging: Print server response

        if (data.includes('Your order has been submitted successfully!')) {
            // Clear cart items from localStorage
            localStorage.removeItem('cartItems');

            // Close modal event listener
            document.querySelector('.close').addEventListener('click', () => {
                modal.style.display = 'none';
                // Redirect to the homepage or any other page
                window.location.href = 'home.html';
            });
        } else {
            alert('Order could not be processed. Please try again.');
        }
    })
    .catch(error => console.error('Error:', error));
}
