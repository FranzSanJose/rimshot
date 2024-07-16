document.addEventListener('DOMContentLoaded', function() {
    // Load user info from localStorage and display it
    const email = localStorage.getItem('email');
    const username = localStorage.getItem('username');
    const address = localStorage.getItem('address');
    const contact = localStorage.getItem('contact');

    if (username) {
        const userInfo = document.getElementById('user-info');
        userInfo.innerHTML = `
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>Username:</strong> ${username}</p>
            <p><strong>Address:</strong> ${address}</p>
            <p><strong>Contact:</strong> ${contact}</p>
        `;
    }

    // Load cart items from localStorage and display them in order summary
    const orderItems = JSON.parse(localStorage.getItem('cartItems'));
    if (orderItems) {
        const orderItemsContainer = document.getElementById('order-items');
        let orderSubtotal = 0;

        orderItems.forEach(item => {
            const subtotal = item.price * item.quantity;
            orderSubtotal += subtotal;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.id}</td>
                <td><img src="${item.image}" alt="${item.name}" style="width: 130px;"></td>
                <td>${item.name}</td>
                <td>${item.size}</td>
                <td>₱${item.price}</td>
                <td>${item.quantity}</td>
                <td>₱${subtotal}</td>
            `;
            orderItemsContainer.appendChild(row);
        });

        const orderTotal = orderSubtotal + 38;

        document.getElementById('order-subtotal').textContent = `₱${orderSubtotal}`;
        document.getElementById('order-total').textContent = `₱${orderTotal}`;
    }
});

function placeOrder() {
    // Simulate placing an order and then clear the cart
    alert('Order placed successfully!');
    localStorage.removeItem('cartItems');
    window.location.href = 'home.html';
}
