<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMSHOT</title>
    <link rel="icon" href="logo.png" type="png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
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
                <li><a class="active" href="shop.php"><i class="fa-solid fa-store"></i> Shop</a></li>
                <li><a href="about.php"><i class="fa-solid fa-circle-info"></i> About</a></li>
                <li><a href="contact.php"><i class="fa-solid fa-phone"></i> Contact</a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a  href="cart.php"><i class="fa-solid fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
    </header>

   
    
 
    <section id="product1" class="section-p1">
        <h2> NEW ARRIVAL Shop Now!</h2>
        <h3> " You miss 100% of the shots you don’t take . "</h3>
        <div id="product-container" class="pro-container hidden">
            
            <div class="pro hidden">
                <a href="#"><img src="product3.png" alt=""></a>
                <div class="des">
                    <span>Rimshot</span>
                    <h5>"The Good Baller"</h5>
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4>₱450</h4>
                </div>
                <a href="sproduct3.php" class="shopping-cart-link">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                 </a>
            </div>
        
            <div class="pro">
                <a href="#"><img src="product1.png" alt=""></a>
                <div class="des">
                    <span>Rimshot</span>
                    <h5>"I'll ball ti'l the day i fall"</h5>
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4>₱400</h4>
                </div>
                <a href="sproduct.php" class="shopping-cart-link">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                </a>
            </div>

            <div class="pro hidden">
                <a href="#"><img src="product4.png" alt=""></a>
                <div class="des">
                    <span>Rimshot</span>
                    <h5>"Micahel Jordan Rimshot"</h5>
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4>₱500</h4>
                </div>
                <a href="sproduct4.php" class="shopping-cart-link">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                 </a>
            </div>    

            <div class="pro hidden">
                <a href="#"><img src="product2.png" alt=""></a>
                <div class="des">
                    <span>Rimshot</span>
                    <h5>"Old School Ballers Vibes"</h5>
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h4>₱380</h4>
                </div>
                <a href="sproduct2.php" class="shopping-cart-link">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                </a>
            </div>

           


            
        </div>
    </section> 
  
        <script>
            function toggleNavbar() {
                var navbar = document.getElementById("navbar");
                navbar.classList.toggle("active");
            }
        </script>
    
</body>
</html>
