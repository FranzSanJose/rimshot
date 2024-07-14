<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please LOG IN FIRST. You will be redirected shortly.</p>";
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
</head>

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

<body>

   
  

    <header id="header">
        <a href="home.html"><img src="logo.png" class="logo" alt="Logo"></a>
        <i class="fa fa-bars icon" onclick="toggleNavbar()"></i>
        <nav>
            <ul id="navbar">
                <li><a  href="cart.php"><i class="fa-solid fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
    </header>
  

    <section id="prodetails" class="section-p1">
        <div class="single-pro-container">
        <div class="single-row-image">
            <img src="product1.png" width="100%" id="MainImg" alt="">
        
    
</div>
        
        <div class="single-pro-details">
            <h4>I'll ball ti'l the day i fall</h4>
            <h6>White</h6>
            <h2> ₱400</h2>
            <select id="sizeSelect">
                <option value="" disabled selected>Select size</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="XL">XL</option>
            </select>
            
            <input type="number" id="quantityInput" value="1" min="0">
            <button id="add-to-cart-btn" class="normal">Add To Cart</button>
            <br>
            <h4> Product Details</h4>
            <span><span>Graphic tees are a type of t-shirt that features a graphic design, such as a logo, image, or text. They are a popular clothing item for people of all ages and genders.
                 Graphic tees can be used to express personal style, interests, or beliefs.
                "Don't mind about the others, Just play your own game". The message is encouraging people to not worry about what others think and to focus on their own goals and dreams.</span>
            
                 
                
        </div>
    </section>



    
   


    
    <!-- Add the following script at the end of your php body -->
  <script src="sproduct.js"> </script>
  <script>
        function toggleNavbar() {
            var navbar = document.getElementById("navbar");
            navbar.classList.toggle("active");
        }
    </script>
</body>
</html>