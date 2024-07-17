document.addEventListener('DOMContentLoaded', function() {
    // Retrieve the stored items from localStorage
    const storedItems = JSON.parse(localStorage.getItem('cartItems'));

    // Check if there are any items stored
    if (storedItems && storedItems.length > 0) {
        displayCartItems(storedItems);
    } else {
        // Handle the case where there are no items in the cart
        document.getElementById('cart-items').innerHTML = '<tr><td colspan="7">Your cart is EMPTY</td></tr>';
        document.getElementById('cart-subtotal').textContent = '₱0';
        document.getElementById('cart-total').textContent = '₱38'; // Only shipping cost
    }

    // Load profile information
    loadProfile();
});

function displayCartItems(items) {
    const cartItemsContainer = document.getElementById('cart-items');
    let cartSubtotal = 0;

    cartItemsContainer.innerHTML = ''; // Clear existing content

    items.forEach(item => {
        const subtotal = item.price * item.quantity;
        cartSubtotal += subtotal;

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
        cartItemsContainer.appendChild(row);
    });

    const cartTotal = cartSubtotal + 38;

    document.getElementById('cart-subtotal').textContent = `₱${cartSubtotal}`;
    document.getElementById('cart-total').textContent = `₱${cartTotal}`;
}

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

function checkoutClicked() {
    // Clear cartItems from localStorage
    localStorage.removeItem('cartItems');
    // Optionally, reset the cart items array
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '<tr><td colspan="7">Your cart is EMPTY</td></tr>';
    document.getElementById('cart-subtotal').textContent = '₱0';
    document.getElementById('cart-total').textContent = '₱38'; // Only shipping cost

    // Optionally, redirect to a different page
    window.location.href = 'checkout.html';
}

function placeOrder() {
    // Simulate placing an order and then clear the cart
    alert('Order placed successfully!');
    window.location.href = 'home.html';
}
