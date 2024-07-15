<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please LOG IN FIRST to access Cart. You will be redirected shortly.</p>";
    echo "<script>
            setTimeout(function(){
                window.location.href = 'login.html';
            }, 3000);
          </script>";
    exit();
}

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.html");
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
$stmt = $conn->prepare("SELECT email, username, address, contact, profile_picture FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email, $username, $address, $contact, $profile_picture);
$stmt->fetch();
$stmt->close();

// Optionally, clear cartItems after checkout
if (empty($_SESSION['cartItems'])) {
    // Clear cartItems or perform necessary actions after checkout
}

$conn->close();
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

    <style>
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
    </style>
</head>

<body>

    <header id="header">
        <a href="home.html"><img src="logo.png" class="logo" alt="Logo"></a>
        <i class="fa fa-bars icon" onclick="toggleNavbar()"></i>
        <nav>
            <ul id="navbar">
                <li><a href="home.html"><i class="fa-solid fa-house-chimney"></i> Home</a></li>
                <li><a href="shop.php"><i class="fa-solid fa-store"></i> Shop</a></li>
                <li><a href="about.php"><i class="fa-solid fa-circle-info"></i> About</a></li>
                <li><a href="contact.php"><i class="fa-solid fa-phone"></i> Contact</a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a class="active" href="cart.php"><i class="fa-solid fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
    </header>

    <section id="cart" class="section-p1">
        <table width="100%" id="cart-table" class="section-p1">
            <thead>
                <tr>
                    <th><i class="fa-solid fa-trash-can"></i></th>
                    <th>Item ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Cart items will be dynamically added here -->
            </tbody>
        </table>

        <div id="subtotal" class="section-p1">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td id="cart-subtotal">₱0</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td id="cart-shipping">₱38</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id="cart-total"><strong id="cart-total">₱0</strong></td>
                </tr>
            </table>
            <a href="checkout.php"><button class="normal">Proceed to checkout</button></a>
        </div>
    </section>

    <footer>
        <!-- Your footer content here -->
    </footer>

    <script src="cart.js"></script>
    <script>
        function toggleNavbar() {
            var navbar = document.getElementById("navbar");
            navbar.classList.toggle("active");
        }
    </script>

</body>

</html>
