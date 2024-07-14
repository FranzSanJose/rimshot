<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password
$dbname = "signup_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $username = $_POST['username'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
  // Handle profile picture upload
  if (isset($_FILES['profile-picture'])) {
    $profilePicture = $_FILES['profile-picture'];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($profilePicture["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($profilePicture["tmp_name"]);
    if ($check === false) {
      die("File is not an image.");
    }

    // Check file size (optional, adjust limit as needed)
    if ($profilePicture["size"] > 5000000) {
      die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
      die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // Move uploaded file to target directory
    if (!move_uploaded_file($profilePicture["tmp_name"], $targetFile)) {
      echo "Sorry, there was an error uploading your file.";
      // Add error reporting for debugging
      echo '<br> Error: ' . $_FILES['profile-picture']['error'];
      exit;
    }
  } else {
    die("Profile picture is required.");
  }

  // Check if user already exists
  $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    die("User already exists");
  }

  // Insert user data into database
  $stmt = $conn->prepare("INSERT INTO users (email, username, address, contact, password, profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $email, $username, $address, $contact, $password, $targetFile);
  if ($stmt->execute()) {
    echo "Signup successful";
  } else {
    echo "Error: " . $stmt->error;
  }
}
$conn->close();
?>