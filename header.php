<?php 

// Check if the user is logged in and email is set in the session
if (isset($_SESSION['useremail'])) {
    $email = $_SESSION['useremail'];

    // Database connection
    $host = "localhost"; // Replace with your database host
    $username = "root"; // Replace with your database username
    $password = "abhi879687#"; // Replace with your database password
    $database = "spicymonk"; // Replace with your database name

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get the total items in the cart for the logged-in user
    $sql = "SELECT SUM(quantity) AS total_items FROM cart WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the result
    if ($row = $result->fetch_assoc()) {
        $totalItems = $row['total_items'] ? $row['total_items'] : 0; // If no items, set total to 0
        $_SESSION['cartquantity']=$totalItems;
    }

   
}

?>

<!-- header.php -->
<header class="site-header">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.php">
                            <img src="spicymonk-logo.png" width="160" height="36" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="menu.php">Menu</a></li>
                                <li><a href="location.php">Location</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="cart.php">Cart</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-right">
                            <form action="menu.php" class="header-search-form for-des">
                                <input type="search" name="search-result" class="form-input" placeholder="Search Here...">
                                <button type="submit">
                                    <i class="uil uil-search"></i>
                                </button>
                            </form>
                            <a href="cart.php" class="header-btn header-cart">
                                <i class="uil uil-shopping-bag"></i>
                                <span class="cart-number"><?php if(isset($_SESSION['cartquantity'])){echo $_SESSION['cartquantity'];}else{echo "0";} ?></span>
                            </a>
                            <a href="profile.php" class="header-btn">
                                <i class="uil uil-user-md"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>