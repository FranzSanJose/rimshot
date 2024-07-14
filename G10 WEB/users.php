<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - RIMSHOT</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .user {
            background: #fff;
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid black;
            max-width: 650px;
        }
        .user img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .user-details {
            display: flex;
            align-items: center;
            flex-direction: row;
            justify-content: space-evenly;
            
        }
        .user-info {
            display: flex;
            flex-direction: column;
        }

        #users {
            position: relative;
            background-color: gray;
            background-size: cover;
            background-position: top 25% right 0;
            padding: 0 80px;
            display: flex;
            flex-direction: column;
            z-index: 1;
            flex-wrap: nowrap;
        }

        h2{
            color: white;
        }
    </style>
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
    <!-- Header -->
    <header id="header">
        <a ><img src="logo.png" class="logo" alt="Logo"></a>
        <i class="fa fa-bars icon" onclick="toggleNavbar()"></i>
        <nav>
            <ul id="navbar">
                <li><a  href="orders.php"><i class="fa-solid fa-shirt"></i> Orders</a></li>
            </ul>
        </nav>
    </header>

    <section id="users">
        <h2>Users Data List</h2>

        <?php
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

        $sql = "SELECT id, email, username, address, contact, profile_picture FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='user'>
                        <div class='user-details'>
                            <img src='" . $row["profile_picture"] . "' alt='Profile Picture'>
                            <div class='user-info'>
                                <p><strong>ID:</strong> " . $row["id"] . "</p>
                                <p><strong>Email:</strong> " . $row["email"] . "</p>
                                <p><strong>Name:</strong> " . $row["username"] . "</p>
                                <p><strong>Address:</strong> " . $row["address"] . "</p>
                                <p><strong>Contact:</strong> " . $row["contact"] . "</p>
                            </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<p>No users found.</p>";
        }
        $conn->close();
        ?>
    </section>

    <script>
        function toggleNavbar() {
            var navbar = document.getElementById("navbar");
            navbar.classList.toggle("active");
        }
    </script>
</body>
</html>
