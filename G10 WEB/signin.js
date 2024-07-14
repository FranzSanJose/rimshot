document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Make POST request to server
        fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, password })
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Login failed');
            }
        })
        .then(data => {
            // Handle successful login
            console.log(data);
            
            // Retrieve profile data from localStorage
            var email = localStorage.getItem("email");
            var username = localStorage.getItem("username");
            var address = localStorage.getItem("address");
            var contact = localStorage.getItem("contact");

            // Now you can use the retrieved profile data as needed
            document.getElementById("email").textContent = email;
            document.getElementById("username").textContent = username;
            document.getElementById("address").textContent = address;
            document.getElementById("contact").textContent = contact;

            // Redirect to profile page or perform other actions
            window.location.href = "profile.html";
        })
        .catch(error => {
            // Handle login error
            console.error(error);
            alert('Login failed. Please check your username and password.');
        });
    });
});
