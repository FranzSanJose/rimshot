// Function to validate form on submit
function validateForm() {
    var email = document.getElementById("email").value;
    var username = document.getElementById("username").value;
    var address = document.getElementById("address").value;
    var contact = document.getElementById("contact").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm-password").value;
    var emailError = document.getElementById("email-error");

    // Email format validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        emailError.innerText = "Invalid email format";
        return false;
    } else {
        emailError.innerText = "";
    }

    // Password match validation
    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
    }

    // Check password strength
    checkPasswordStrength();

    return true;
}

// Function to check password strength
function checkPasswordStrength() {
    var password = document.getElementById("password").value;
    var strengthIndicator = document.getElementById("password-strength");
    var strength = 0;

    // Regular expressions for password strength
    var regex = {
        lower: /[a-z]/,
        upper: /[A-Z]/,
        numeric: /[0-9]/,
        special: /[$@$!%*?&]/
    };

    // Check each regex
    if (regex.lower.test(password)) strength++;
    if (regex.upper.test(password)) strength++;
    if (regex.numeric.test(password)) strength++;
    if (regex.special.test(password)) strength++;

    // Update strength indicator
    switch(strength) {
        case 0:
        case 1:
            strengthIndicator.style.backgroundColor = "red";
            strengthIndicator.innerText = "Weak";
            break;
        case 2:
            strengthIndicator.style.backgroundColor = "orange";
            strengthIndicator.innerText = "Moderate";
            break;
        case 3:
            strengthIndicator.style.backgroundColor = "yellow";
            strengthIndicator.innerText = "Strong";
            break;
        case 4:
            strengthIndicator.style.backgroundColor = "green";
            strengthIndicator.innerText = "Very Strong";
            break;
    }
    // Show the strength indicator
    strengthIndicator.style.display = "block";
}

// JavaScript to display the preview of the selected profile picture
const profilePictureInput = document.getElementById('profile-picture');
const profilePicturePreview = document.getElementById('profile-picture-preview');

profilePictureInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        profilePicturePreview.src = e.target.result;
    };

    reader.readAsDataURL(file);
});

// Event listener for form submission
document.getElementById("signup-form").addEventListener("submit", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Validate the form
    if (validateForm()) {
        // Get the form data
        var formData = new FormData(this);

        // Send the form data to the server using a POST request
        fetch('signup.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            // Optionally, redirect to another page on successful signup
            // window.location.href = 'profile.html';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});