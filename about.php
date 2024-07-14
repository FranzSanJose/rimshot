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
                <li><a class="active" href="about.php"><i class="fa-solid fa-circle-info"></i> About</a></li>
                <li><a href="contact.php"><i class="fa-solid fa-phone"></i> Contact</a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a  href="cart.php"><i class="fa-solid fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
    </header>

 


    <section id="about-head" class="about">
        <div class="about-content">
            <img src="kobe.jpg" alt="">
            <div class="about-text">
                <h2>About RIMSHOT</h2>
                <p></p>

                <h5>Founded by Reynaldo Paiso, a visionary student hailing from the esteemed Eulogio "Amang" Rodriguez
                    Institute of Science and Technology (EARIST),Rimshot embodies the fusion of creativity, passion, and
                    urban culture.</h5><br>
                <h5>At RIMSHOT, we believe that fashion is more than just clothing; it's a form of self-expression, a
                    canvas where personalities and stories come to life. Our streetwear t-shirts are meticulously
                    crafted to capture the essence of contemporary urban fashion, blending modern aesthetics with
                    timeless design elements.</h5>
                <br>
                <h5>Driven by a commitment to quality and innovation, each RIMSHOT piece is crafted using premium
                    materials and attention to detail, ensuring both comfort and durability. From bold graphics to
                    minimalist designs, our t-shirts are versatile staples that effortlessly complement any wardrobe,
                    making them perfect for everyday wear or special occasions.</h5><br>
                <h5>As a brand founded by students, for students, Rimshot celebrates the pursuit of dreams, the courage
                    to defy conventions, and the power of creativity to inspire change. With each design, we invite you
                    to join us on a journey of self-discovery, empowerment, and endless possibilities.
                    Thank you for choosing Rimshot. Let your style speak volumes, and your journey begin here.</h5>


                <br><br>

                <marquee background color="black" loop="5" scrollamount="15" width="100%">Welcome to RIMSHOT, You miss
                    100% of the shots you dont take.</marquee>
            </div>
    </section>

    </section>

        <script>
            function toggleNavbar() {
                var navbar = document.getElementById("navbar");
                navbar.classList.toggle("active");
            }
        </script>

</body>
</html>