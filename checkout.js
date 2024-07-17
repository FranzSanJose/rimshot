// Function to display the order summary
function displayOrderSummary() {
    // existing code to display order summary
}

// Function to handle order confirmation
function confirmOrder(event) {
    event.preventDefault();

    // existing code for order confirmation

    // Save order to localStorage
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const total = document.getElementById('total').value;
    const order = {
        id: Date.now(),
        items: cartItems,
        total: total,
        date: new Date().toLocaleDateString(),
    };

    let orderHistory = JSON.parse(localStorage.getItem('orderHistory')) || [];
    orderHistory.push(order);
    localStorage.setItem('orderHistory', JSON.stringify(orderHistory));

    // Clear cart and redirect to profile page
    localStorage.removeItem('cartItems');
    window.location.href = 'profile.html';
}

// Invoke the function to display the order summary when the page loads
document.addEventListener('DOMContentLoaded', function() {
    displayOrderSummary();

    // Add event listener for the confirm order button
    document.getElementById('confirm-order-btn').addEventListener('click', confirmOrder);
});

function loadProfile() {
    // existing code to load profile
}

document.addEventListener('DOMContentLoaded', loadProfile);

function placeOrder() {
    // Save order and then clear the cart
    confirmOrder(new Event('submit'));
}
