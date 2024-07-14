<?php
// Database connection details
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

// Handle order confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order_id'])) {
    $order_id = $_POST['confirm_order_id'];
    $update_sql = "UPDATE orders SET status = 'delivered' WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();
    exit();
}

// Fetch orders and order items
$sql = "SELECT o.id AS order_id, o.total, o.created_at, o.status, o.username, o.address, o.contact, oi.item_name, oi.quantity, oi.price, oi.size, oi.image 
        FROM orders o 
        JOIN order_items oi ON o.id = oi.order_id 
        ORDER BY o.created_at DESC";
$result = $conn->query($sql);

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[$row['order_id']]['total'] = $row['total'];
    $orders[$row['order_id']]['created_at'] = $row['created_at'];
    $orders[$row['order_id']]['status'] = $row['status'];
    $orders[$row['order_id']]['username'] = $row['username'];
    $orders[$row['order_id']]['address'] = $row['address'];
    $orders[$row['order_id']]['contact'] = $row['contact'];
    $orders[$row['order_id']]['items'][] = [
        'name' => $row['item_name'],
        'quantity' => $row['quantity'],
        'price' => $row['price'],
        'size' => $row['size'],
        'image' => $row['image']
    ];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - RIMSHOT </title>
    <link rel="icon" href="logo.png" type="png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css">
    <script>
        function toggleOrderDetails(orderId) {
            var details = document.getElementById("order-details-" + orderId);
            if (details.style.maxHeight) {
                details.style.maxHeight = null;
                details.style.padding = '0';
            } else {
                details.style.maxHeight = details.scrollHeight + "px";
                details.style.padding = '20px';
            }
        }

        function confirmOrder(orderId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "orders.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("order-status-" + orderId).innerText = "delivered";
                    document.getElementById("confirm-button-" + orderId).style.display = 'none';
                }
            };
            xhr.send("confirm_order_id=" + orderId);
        }
    </script>
    <style>
        .order-details {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out, padding 0.5s ease-out;
            padding: 0;
        }
        .item {
            display: flex;
            align-items: center;
            padding: 10px 0;
        }
        .item img {
            margin-right: 10px;
        }
        .item div {
            display: flex;
            flex-direction: column;
        }
        .item:last-child {
            border-bottom: none;
        }
        .confirm-button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
            text-align: center;
            border: 2px solid black;
        }
        .confirm-button:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
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
        <a><img src="logo.png" class="logo" alt="Logo"></a>
        <i class="fa fa-bars icon" onclick="toggleNavbar()"></i>
        <nav>
            <ul id="navbar">
                <li><a href="users.php"><i class="fa-solid fa-address-card"></i> Users</a></li>
            </ul>
        </nav>
    </header>

    <section id="orders">
        <h2>Orders</h2>
        <?php if (empty($orders)): ?>
            <p>You have no orders.</p>
        <?php else: ?>
            <?php foreach ($orders as $order_id => $order): ?>
                <div class="order">
                    <h3 style="cursor: default;">Order ID: <?php echo $order_id; ?></h3>
                    <button class="confirm-button" onclick="toggleOrderDetails(<?php echo $order_id; ?>)">Toggle Order Details</button>
                    <div id="order-details-<?php echo $order_id; ?>" class="order-details">
                        <p><strong>User:</strong> <?php echo htmlspecialchars($order['username']); ?></p>
                        <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
                        <p><strong>Total:</strong> ₱<?php echo number_format($order['total'], 2); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
                        <p><strong>Contact:</strong> <?php echo htmlspecialchars($order['contact']); ?></p>
                        <p><strong>Status:</strong> <span id="order-status-<?php echo $order_id; ?>"><?php echo htmlspecialchars($order['status']); ?></span></p>
                        <button id="confirm-button-<?php echo $order_id; ?>" class="confirm-button" onclick="confirmOrder(<?php echo $order_id; ?>)" <?php if ($order['status'] === 'delivered') echo 'style="display: none;"'; ?>>Confirm Order</button>
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
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <style>
        p {
            font-size: 16px;
            color: black;
            margin: 15px 0 20px 0;
            background-color: white;
        }
        #orders {
            position: relative; /* Ensure the position is relative */
            background-image: url(background.png);
            background-size: cover;
            background-position: top 25% right 0;
            padding: 0 80px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            z-index: 1; /* Keep the z-index */
            background-attachment: fixed;
            height: 300vh;
        }

        #orders::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 0; /* Ensure this is lower than the z-index of the content */
        }

        #orders > * {
            position: relative;
            z-index: 1;
            margin-top: 20px;
        }

        .order {
            background: #fff;
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid black;
        }
        .order h3 {
            margin-top: 0;
        }
        .item {
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 10px 0;
        }
        .item img {
            margin-right: 10px;
        }
        .item div {
            display: flex;
            flex-direction: column;
        }
        .item:last-child {
            border-bottom: none;
        }

        h2{
            color: white;
        }
    </style>

    <script>
        function toggleNavbar() {
            var navbar = document.getElementById("navbar");
            navbar.classList.toggle("active");
        }
    </script>
</body>
</html>
