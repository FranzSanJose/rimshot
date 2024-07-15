let cartItems = [];

function generateUniqueId() {
    return '_' + Math.random().toString(36).substr(2, 9);
}

function renderCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    let cartSubtotal = 0;

    cartItemsContainer.innerHTML = ''; // Clear existing content

    const proceedButton = document.querySelector('#cart #subtotal a');

    if (cartItems.length === 0) {
        cartItemsContainer.innerHTML = '<tr><td colspan="8">Your cart is EMPTY</td></tr>';
        proceedButton.classList.add('disabled');
        proceedButton.removeAttribute('href');
        document.getElementById('cart-subtotal').textContent = '₱0';
        document.getElementById('cart-total').textContent = '₱38'; // Only shipping cost
        return;
    } else {
        proceedButton.classList.remove('disabled');
        proceedButton.href = 'checkout.php';
    }

    cartItems.forEach(item => {
        const subtotal = item.price * item.quantity;
        cartSubtotal += subtotal;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><button class="remove-item" data-id="${item.id}">Remove</button></td>
            <td>${item.id}</td>
            <td><img src="${item.image}" alt="${item.name}" style="width: 130px;"></td>
            <td>${item.name}</td>
            <td>${item.size}</td>
            <td>₱${item.price}</td>
            <td><input type="number" value="${item.quantity}" class="item-quantity" data-id="${item.id}"></td>
            <td>₱${subtotal}</td>
        `;
        cartItemsContainer.appendChild(row);
    });

    const cartTotal = cartSubtotal + 38;

    document.getElementById('cart-subtotal').textContent = `₱${cartSubtotal}`;
    document.getElementById('cart-total').textContent = `₱${cartTotal}`;

    // Store the updated cartItems in localStorage
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
}


document.addEventListener('change', function(event) {
    if (event.target.classList.contains('item-quantity')) {
        const itemId = event.target.dataset.id;
        const newQuantity = parseInt(event.target.value);

        const validQuantity = Math.max(newQuantity, 0);

        cartItems.forEach(item => {
            if (item.id === itemId) {
                item.quantity = validQuantity;
            }
        });

        renderCartItems();
    }
});

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-item')) {
        const itemId = event.target.dataset.id;
        cartItems = cartItems.filter(item => item.id !== itemId);

        // Update localStorage after removing an item
        localStorage.setItem('cartItems', JSON.stringify(cartItems));

        renderCartItems();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const storedItems = JSON.parse(localStorage.getItem('cartItems'));
    if (storedItems) {
        cartItems = storedItems;
        renderCartItems();
    }
});


function checkoutClicked() {
    // Clear cartItems from localStorage
    localStorage.removeItem('cartItems');
    // Reset cartItems array
    cartItems = [];
    // Render empty cart
    renderCartItems();
    // Optionally, redirect to checkout.php
    window.location.href = 'checkout.php';
}
