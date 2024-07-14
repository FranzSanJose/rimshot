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

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "edit_profile.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert("Profile updated successfully!");
            window.location.reload();
        }
    };
    xhr.send("email=" + encodeURIComponent(email) +
             "&username=" + encodeURIComponent(username) +
             "&address=" + encodeURIComponent(address) +
             "&contact=" + encodeURIComponent(contact));
}
