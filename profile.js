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
