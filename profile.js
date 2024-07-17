function toggleEditForm() {
    const form = document.getElementById('edit-profile-form');
    form.classList.toggle('hidden');
}

function submitProfileChanges(event) {
    event.preventDefault();
    const email = document.getElementById('new-email').value;
    const username = document.getElementById('new-username').value;
    const address = document.getElementById('new-address').value;
    const contact = document.getElementById('new-contact').value;

    localStorage.setItem('email', email);
    localStorage.setItem('username', username);
    localStorage.setItem('address', address);
    localStorage.setItem('contact', contact);

    alert("Profile updated successfully!");
    window.location.reload();
}

function previewProfilePicture(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('profile-picture-preview');
        output.src = reader.result;
        localStorage.setItem('profilePicture', reader.result);
    };
    reader.readAsDataURL(event.target.files[0]);
}

function loadProfile() {
    const profilePicture = localStorage.getItem('profilePicture');
    const email = localStorage.getItem('email');
    const username = localStorage.getItem('username');
    const address = localStorage.getItem('address');
    const contact = localStorage.getItem('contact');

    document.getElementById('profile-picture-preview').src = profilePicture ? profilePicture : 'default-profile.png';
    document.getElementById('email').innerText = email ? email : 'N/A';
    document.getElementById('username').innerText = username ? username : 'N/A';
    document.getElementById('address').innerText = address ? address : 'N/A';
    document.getElementById('contact').innerText = contact ? contact : 'N/A';
}

function loadOrderHistory() {
    const orderHistory = JSON.parse(localStorage.getItem('orderHistory')) || [];
    const orderHistoryContent = document.getElementById('order-history-content');

    if (orderHistory.length === 0) {
        orderHistoryContent.innerHTML = '<p>You have no orders.</p>';
        return;
    }

    orderHistoryContent.innerHTML = orderHistory.map(order => `
        <div class="order">
            <p><strong>Order ID:</strong> ${order.id}</p>
            <p><strong>Date:</strong> ${order.date}</p>
            <p><strong>Total:</strong> ₱${order.total}</p>
            <p><strong>Status:</strong>  ${order.status ? order.status : 'Pending'}</p>
            <div class="order-items">
                ${order.items.map(item => `
                    <div class="item">
                        <p><strong>Item Name:</strong> ${item.name}</p>
                        <p><strong>Quantity:</strong> ${item.quantity}</p>
                        <p><strong>Size:</strong> ${item.size}</p>
                    </div>
                `).join('')}
            </div>
        </div>
    `).join('');
}

document.addEventListener('DOMContentLoaded', function() {
    loadProfile();
    loadOrderHistory();
});
