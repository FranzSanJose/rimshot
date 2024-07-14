<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please LOG IN FIRST to access Contact. You will be redirected shortly.</p>";
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
                <li><a  href="home.html"><i class="fa-solid fa-house-chimney"></i> Home</a></li>
                <li><a  href="shop.php"><i class="fa-solid fa-store"></i> Shop</a></li>
                <li><a  href="about.php"><i class="fa-solid fa-circle-info"></i> About</a></li>
                <li><a class="active" href="contact.php"><i class="fa-solid fa-phone"></i> Contact</a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a  href="cart.php"><i class="fa-solid fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
    </header>

    
  

    <section id="contact-details" class="section-p1">
        <div class="details">
          
            <h2> Contact us </h2>
            <h3>Main Office</h3>
            <div>
                <li>
                    <i class="fa-regular fa-map"></i>
                    <p>836 Leyte St. Sampaloc Manila</p>
                </li>
                <li>
                    <i class="fa-regular fa-envelope"></i>
                    <p>dominicjamesbernil@gmail.com</p>
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <p>09319929400</p>
                </li>
                <li>
                    <i class="fa-regular fa-clock"></i>
                    <p>Monday - Friday 1:00 PM - 8:00 PM</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.8425590877555!2d121.00541097489877!3d14.608043085879205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b61fca79df3f%3A0x76fd8f4596882117!2s835%20Leyte%20St%2C%20Sampaloc%2C%20Manila%2C%201008%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1713153801980!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </iframe>
        </div>

         
    </section>

    <section id="form-details">
    <div class="people">
        <div class="people">
            <img src="doms.jpg" alt="">
            <div>
                <h3>Dominic James Bernil</h3>
                <h4>FOUNDER</h4>
                <h5>Phone: 09319929400</h5>
                <h5>dominicjamesbernil@gmail.com</h5>
            </div>
        </div>
        
        <div class="people">
            <img src="franz.jpg" alt="">
            <div>
                <h3>Franz Arnel San Jose</h3>
                <h4>MANAGER</h4>
                <h5>Phone: 09455480638</h5>
                <h5>sanjose.fa.bsinfotech@gmail.com</h5>
            </div>
        </div>
        
        <div class="people">
            <img src="rey.jpg" alt="">
            <div>
                <h3>Reynaldo Paiso Jr.</h3>
                <h4>ASSISTANT MANAGER</h4>
                <h5>Phone: 09638774555</h5>
                <h5>paisojr.r.bsinfotech@gmail.com</h5>
            </div>
        </div>
    </div>
</section>

         


    </section>



    <footer class="footer">
        <div id="logo" class="col">
            <h3>RIMSHOT.</h3><br>
            
    </div>


  


      
   
       
    </footer>

 
    <script>
        function toggleNavbar() {
        var navbar = document.getElementById("navbar");
        navbar.classList.toggle("active");
        }
    </script>    
   
</body>

</html>