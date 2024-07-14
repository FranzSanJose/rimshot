<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please LOG IN FIRST to access My Account. You will be redirected shortly.</p>";
    echo "<script>
            setTimeout(function(){
                window.location.href = 'login.html';
            }, 3000);
          </script>";
    exit();
}

if (isset($_POST['logout'])) {
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

// Fetch orders for the logged-in user
$sql = "SELECT o.id AS order_id, o.total, o.created_at, o.status, oi.item_name, oi.quantity, oi.price, oi.size, oi.image 
        FROM orders o 
        JOIN order_items oi ON o.id = oi.order_id 
        WHERE o.user_id = ? 
        ORDER BY o.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[$row['order_id']]['total'] = $row['total'];
    $orders[$row['order_id']]['created_at'] = $row['created_at'];
    $orders[$row['order_id']]['status'] = $row['status'];
    $orders[$row['order_id']]['items'][] = [
        'name' => $row['item_name'],
        'quantity' => $row['quantity'],
        'price' => $row['price'],
        'size' => $row['size'],
        'image' => $row['image']
    ];
}

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
    <link rel="stylesheet" href="profile.css">
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
        border: 2px solid white;
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
            padding: 10px;
        }
    }

    .hidden {
        display: none;
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
                <li><a  href="contact.php"><i class="fa-solid fa-phone"></i> Contact</a></li>
                <li><a class="active" href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a  href="cart.php"><i class="fa-solid fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
    </header>

<section id="profile" class="profile-bg">
    <div class="profile-container">
        <h2>Profile</h2>
        <div class="form-group">
            <label for="profile-picture">Profile Picture:</label>
            <img id="profile-picture-preview" src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture">
        </div>
        <div id="profile-info">
            <p>Email: <span id="email"><?php echo htmlspecialchars($email); ?></span></p>
            <p>Username: <span id="username"><?php echo htmlspecialchars($username); ?></span></p>
            <p>Address: <span id="address"><?php echo htmlspecialchars($address); ?></span></p>
            <p>Contact No: <span id="contact"><?php echo htmlspecialchars($contact); ?></span></p>
        </div>
        
        <div class="Edit">
            <button onclick="toggleEditForm()">Edit Profile</button>
            <p></p>
            <form id="edit-profile-form" class="hidden" onsubmit="submitProfileChanges(event)">
                <input type="email" id="new-email" placeholder="New Email" required>
                <br>
                <input type="text" id="new-username" placeholder="New Username" required>
                <br>
                <input type="text" id="new-address" placeholder="New Address" required>
                <br>
                <input type="tel" id="new-contact" placeholder="New Contact No." required>
                <br>
                <p></p>
                <button type="submit">Save Changes</button>
            </form>
            <form method="post">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</section>

<section id="order-history" class="order-history-bg">
    <div class="order-history-container">
        <h2>Order History</h2>
        <button onclick="toggleOrderHistory()">Toggle Order History</button>
        <div id="order-history-content" class="hidden">
            <?php if (empty($orders)): ?>
                <p>You have no orders.</p>
            <?php else: ?>
                <?php foreach ($orders as $order_id => $order): ?>
                    <div class="order">
                        <h3>Order ID: <?php echo $order_id; ?></h3>
                        <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
                        <p><strong>Total:</strong> ₱<?php echo number_format($order['total'], 2); ?></p>
                        <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
                        <h4>Items:</h4>
                        <?php foreach ($order['items'] as $item): ?>
                            <div class="item">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 70px;">
                                <div>
                                    <p><strong>Item:</strong> <?php echo htmlspecialchars($item['name']); ?></p>
                                    <p><strong>Quantity:</strong> <?php echo $item['quantity']; ?></p>
                                    <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size']); ?></p>
                                    <p><strong>Price:</strong> ₱<?php echo number_format($item['price'], 2); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="profile.js"></script>
<script>
    function toggleNavbar() {
        var navbar = document.getElementById("navbar");
        navbar.classList.toggle("active");
    }

    function toggleOrderHistory() {
        var orderHistoryContent = document.getElementById("order-history-content");
        orderHistoryContent.classList.toggle("hidden");
    }

    function toggleEditForm() {
        var editForm = document.getElementById("edit-profile-form");
        editForm.classList.toggle("hidden");
    }

    function submitProfileChanges(event) {
        event.preventDefault();
        // Add your AJAX code here to submit the profile changes
    }
</script>
</body>
</html>
