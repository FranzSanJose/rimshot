<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please LOG IN FIRST to access Checkout. You will be redirected shortly.</p>";
    echo "<script>
            setTimeout(function(){
                window.location.href = 'login.html';
            }, 3000);
          </script>";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT email, username, address, contact FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email, $username, $address, $contact);
$stmt->fetch();
$stmt->close();

if (isset($_POST['submit_order'])) {
    $total = $_POST['total'];
    $cartItems = json_decode($_POST['cartItems'], true);

    // Debug: Print variables
    echo "<p>User ID: $user_id</p>";
    echo "<p>Total: $total</p>";
    echo "<p>Username: $username</p>";
    echo "<p>Address: $address</p>";
    echo "<p>Contact: $contact</p>";
    echo "<pre>";
    print_r($cartItems);
    echo "</pre>";

    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total, username, address, contact) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("idsss", $user_id, $total, $username, $address, $contact);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert order items
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_id, item_name, quantity, price, size, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    foreach ($cartItems as $item) {
        // Ensure the image data is set and not empty
        $image = isset($item['image']) ? $item['image'] : 'default_image.png'; // Provide a default image if not set
        $stmt->bind_param("iisidss", $order_id, $item['id'], $item['name'], $item['quantity'], $item['price'], $item['size'], $image);
        if (!$stmt->execute()) {
            die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }
    }

    $stmt->close();
    $conn->close();

    echo "<p>Your order has been submitted successfully!</p>";
    echo "<script>
            setTimeout(function(){
                window.location.href = 'home.html';
            }, 3000);
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMSHOT</title>
    <link rel="icon" href="logo.png" type="png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css" />
    <link rel="stylesheet" href="style.css">
</head>
<style>
#checkout {
    padding: 40px 80px;
    background-image: url(background.png);
    background-size: cover;
    background-position: top 25% right 0;
    position: relative;
    background-attachment: fixed;
}

#checkout::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
    z-index: 1; /* Ensure the pseudo-element is behind the background */
}

.checkout-container {
    position: relative; /* Ensure the content stays above the pseudo-element */
    z-index: 1; /* Ensure the content stays above the pseudo-element */
}

/* Navbar styling */
#header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: black;
    color: white;
}

#navbar {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
}

#navbar li {
    margin-right: 15px;
}

#navbar li:last-child {
    margin-right: 0;
}

#navbar li a {
    color: white;
    text-decoration: none;
    padding: 10px;
}

#navbar li a:hover {
    background-color: white;
    color: black;
    border-radius: 5px;
}

.logo {
    height: 60px;
    width: auto;
}

/* Hamburger menu */
.icon {
    display: none;
    color: white;
    cursor: pointer;
}

@media screen and (max-width: 768px) {
    #navbar {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        background-color: #333;
    }

    #navbar.active {
        display: flex;
        background-color: black
    }

    .icon {
        display: block;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    #navbar li {
        margin-right: 0;
        text-align: center;
        width: 100%;
    }
}

#order-form {
    border: 2px solid black;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
}
</style>
<body>
    <!-- Header -->
    <header id="header">
        <a href="home.html"><img src="logo.png" class="logo" alt="Logo"></a>
       
        <nav>
            <ul id="navbar">
             
            </ul>
        </nav>
    </header>

    <section id="checkout">
    <div class="checkout-container">
        <h2>Checkout</h2>
        <div class="order-summary">
            <!-- Order summary will be displayed here -->
        </div>
        <form method="post" id="order-form">
            <p><b>User Information:</b></p>
            <p><b>Name: </b><?php echo htmlspecialchars($username); ?></p>
            <p><b>Address: </b><?php echo htmlspecialchars($address); ?></p>
            <p><b>Contact: </b><?php echo htmlspecialchars($contact); ?></p>
            <input type="hidden" name="total" id="total" value="">
            <input type="hidden" name="cartItems" id="cartItems" value="">
            <button type="submit" name="submit_order" id="confirm-order-btn">Confirm Order</button>
        </form>
    </div>

    <!-- Modal for order confirmation -->
    <div id="order-confirmation-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Order Confirmation</h2>
            <p>Your order has been confirmed!</p>
        </div>
    </div>

    <script src="checkout.js"></script>
</body>
</html>
