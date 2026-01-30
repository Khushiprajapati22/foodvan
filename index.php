<?php
session_start();
if (isset($_SESSION['serch-value-fetch'])) {
    unset($_SESSION['serch-value-fetch']);
}

// Check if the user is logged in and email is set in the session
if (isset($_SESSION['useremail'])) {
    $email = $_SESSION['useremail'];
    include 'db.php';
    // Database connection
    // $host = "localhost"; // Replace with your database host
    // $username = "root"; // Replace with your database username
    // $password = "abhi879687#"; // Replace with your database password
    // $database = "spicymonk"; // Replace with your database name

    // $conn = new mysqli($host, $username, $password, $database);

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
        $_SESSION['cartquantity'] = $totalItems;
    }

    // Close the connection
    $stmt->close();
    // $conn->close(); // Commented out - connection needed for header.php
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodVan</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Resources/SpicyMonk-Logo-V2.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body class="body-fixed">
    <!-- <header class="site-header">
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
                            <a href="javascript:void(0)" class="header-btn header-cart">
                                <i class="uil uil-shopping-bag"></i>
                                <span class="cart-number">?php if(isset($_SESSION['cartquantity'])){echo $_SESSION['cartquantity'];}else{echo "0";} ?></span>
                            </a>
                            <a href="profile.php" class="header-btn">
                                <i class="uil uil-user-md"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> -->
    <?php
    include 'header.php';
    ?>


    <!-- Backround Move Image -->
    <div id="viewport">
        <div id="js-scroll-content">
            <section class="main-banner" id="home">
                <div class="js-parallax-scene" style="display: none;">
                    <div class="banner-shape-1 w-100" data-depth="0.30">
                        <img src="assets/icons/plant-background.png" alt="">
                    </div>
                    <div class="banner-shape-2 w-100" data-depth="0.25">
                        <img src="assets/icons/plant-background.png" alt="">
                    </div>
                </div>
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-text">
                                    <h1 class="h1-title animate__animated " data-animation="animate__slideInLeft">
                                        Fresh Flavors
                                        <span style="color: #0b6119;">On The</span>
                                        Go!
                                    </h1>
                                    <p> Taste the best food on wheels! Quick, fresh, and bursting with flavor – just a
                                        click away. Order now and make your mealtime extraordinary!.</p>
                                    <div class="banner-btn mt-4">
                                        <a href="#menu" class="sec-btn">Explore Menu</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img-wp">
                                    <div class="banner-img"
                                        style="background-image: url(assets/images/Home-main-bg.jpg);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="about-sec section" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sec-title text-center mb-5 ">
                                <p class="sec-sub-title mb-3 ">About Us</p>
                                <h2 class="h2-title animate__animated" data-animation="animate__fadeInUp">Discover our
                                    <span>restaurant story</span>
                                </h2>
                                <div class="sec-title-shape mb-4 animate__animated" data-animation="animate__fadeInUp">
                                    <img src="assets/images/green-line.png" alt="" width="50%" height="50%">
                                </div>
                                <p class="animate__animated" data-animation="animate__fadeInUp">We are dedicated to
                                    bringing you the finest quality and service with every bite. Our mission is to
                                    create unforgettable dining experiences by combining fresh ingredients, authentic
                                    recipes, and a passion for excellence. Your trust and satisfaction drive us to
                                    continuously improve and deliver more than just a meal—it’s a promise of care and
                                    commitment. From our kitchen to your table, we aim to exceed your expectations and
                                    leave you craving for more!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-8 m-auto">
                            <div class="about-video">
                                <div class="about-video-img" style="background-image: url(assets/images/blog/b6.jpg);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section style="background-image: url(assets/images/menu-bg.png);"
                class="our-menu section bg-light repeat-img" id="menu">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">our menu</p>
                                    <h2 class="h2-title animate__animated" data-animation="animate__fadeInUp">Early
                                        mornings, <span>fresh meals & healthy vibe</span></h2>
                                    <div class="sec-title-shape mb-4 animate__animated"
                                        data-animation="animate__fadeInUp">
                                        <img src="assets/images/green-line.png" alt="" width="50%" height="50%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-tab-wp">
                            <div class="row">
                                <div class="col-lg-12 m-auto">
                                </div>
                            </div>
                        </div>


                        <div class="menu-list-row">
                            <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                                <div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/dish/spicy-noodles-black.png" alt="" height="85%"
                                                width="85%">
                                        </div>
                                        <div class="dish-rating">
                                            4.8
                                            <i class="uil uil-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Asian Noodles</h3>
                                            <p>Crispy Crunch</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Veg</b>
                                                </li>
                                                <li>
                                                    <p>Persons</p>
                                                    <b>1</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rs. 245</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn" onclick="addToCart(this)">
                                                        <i class="uil uil-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp breakfast" data-cat="breakfast">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/dish/Dish-5.png" alt="" height="85%" width="85%">
                                        </div>
                                        <div class="dish-rating">
                                            4.7
                                            <i class="uil uil-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Spicy Red O' Nod</h3>
                                            <p>Hearty Bowls</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Non Veg</b>
                                                </li>
                                                <li>
                                                    <p>Persons</p>
                                                    <b>2</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rs. 219</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn" onclick="addToCart(this)">
                                                        <i class="uil uil-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp lunch" data-cat="lunch">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/dish/Dish-4.png" alt="" height="85%" width="85%">
                                        </div>
                                        <div class="dish-rating">
                                            4.6
                                            <i class="uil uil-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Korean Spicy Stew</h3>
                                            <p>Fiery Spice</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Non Veg</b>
                                                </li>
                                                <li>
                                                    <p>Persons</p>
                                                    <b>2</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rs. 349</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn" onclick="addToCart(this)">
                                                        <i class="uil uil-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp lunch" data-cat="lunch">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/dish/4.png" alt="" height="85%" width="85%">
                                        </div>
                                        <div class="dish-rating">
                                            4.1
                                            <i class="uil uil-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Spicy O'il Haka</h3>
                                            <p>Wholesome Delights</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Veg</b>
                                                </li>
                                                <li>
                                                    <p>Persons</p>
                                                    <b>1</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rs. 249</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn" onclick="addToCart(this)">
                                                        <i class="uil uil-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- 5 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp dinner" data-cat="dinner">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/dish/Dish-3.png" alt="" height="85%" width="85%">
                                        </div>
                                        <div class="dish-rating">
                                            4.7
                                            <i class="uil uil-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Red Souce Noodles</h3>
                                            <p> fresh greens.</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Veg</b>
                                                </li>
                                                <li>
                                                    <p>Persons</p>
                                                    <b>1</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rs. 189</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn" onclick="addToCart(this)">
                                                        <i class="uil uil-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- 6 -->
                                <div class="col-lg-4 col-sm-6 dish-box-wp dinner" data-cat="dinner">
                                    <div class="dish-box text-center">
                                        <div class="dist-img">
                                            <img src="assets/images/dish/Dish-2.png" alt="" height="85%" width="85%">
                                        </div>
                                        <div class="dish-rating">
                                            4.4
                                            <i class="uil uil-star"></i>
                                        </div>
                                        <div class="dish-title">
                                            <h3 class="h3-title">Spaghetti Aglio e Olio</h3>
                                            <p>Golden Crusts</p>
                                        </div>
                                        <div class="dish-info">
                                            <ul>
                                                <li>
                                                    <p>Type</p>
                                                    <b>Non Veg</b>
                                                </li>
                                                <li>
                                                    <p>Persons</p>
                                                    <b>2</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dist-bottom-row">
                                            <ul>
                                                <li>
                                                    <b>Rs. 159</b>
                                                </li>
                                                <li>
                                                    <button class="dish-add-btn" onclick="addToCart(this)">
                                                        <i class="uil uil-plus"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="brands-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="brands-row">
                                <div class="brands-box">
                                    <img src="assets/images/dish/spicy-noodles-black.png" alt="" width="200px"
                                        height="100%">
                                </div>
                                <div class="brands-box">
                                    <img src="assets/images/dish/Dish-2.png" alt="" width="200px" height="100%">
                                </div>
                                <div class="brands-box">
                                    <img src="assets/images/dish/Dish-3.png" alt="" width="200px" height="100%">
                                </div>
                                <div class="brands-box">
                                    <img src="assets/images/dish/Dish-4.png" alt="" width="200px" height="100%">
                                </div>
                                <div class="brands-box">
                                    <img src="assets/images/dish/Dish-5.png" alt="" width="200px" height="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="two-col-sec section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="sec-img mt-5">
                                <img src="assets/images/dish/Dish-2.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="sec-text">
                                <h2 class="xxl-title animate__animated" data-animation="animate__fadeInRight">Spaghetti
                                    Aglio e Olio</h2>
                                <p class="animate__animated" data-animation="animate__fadeInRight">Noodles, a timeless
                                    classic, bring comfort and flavor to every bite. From steaming bowls of spicy ramen
                                    to stir-fried delights, they capture the essence of diverse cuisines worldwide.
                                    Crafted with the perfect balance of texture and taste, noodles adapt effortlessly to
                                    rich broths, vibrant vegetables, and savory sauces. Whether enjoyed as a quick snack
                                    or a hearty meal, they always deliver satisfaction. Light, versatile, and endlessly
                                    customizable, noodles are a canvas for culinary creativity that warms the soul and
                                    excites the palate."

                                    <br><br> Every noodle dish tells a story of culture and tradition, uniting people
                                    through a shared love for simple yet extraordinary flavors. Whether topped with
                                    fresh herbs, tender proteins, or a spicy kick, noodles remain a universal favorite
                                    that’s both comforting and exciting
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="two-col-sec section pt-0">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 order-lg-1 order-2">
                            <div class="sec-text">
                                <h2 class="xxl-title animate__animated" data-animation="animate__fadeInLeft">Korean
                                    Spicy Stew </h2>
                                <p class="animate__animated" data-animation="animate__fadeInLeft">Stews, a timeless
                                    comfort food, bring warmth and flavor to every meal. From rich, hearty beef stews to
                                    spicy global variations, they embody the essence of home cooking and culinary
                                    tradition. Slow-cooked to perfection, stews blend tender meats, vibrant vegetables,
                                    and aromatic spices into a wholesome, satisfying dish. Whether served with rice,
                                    bread, or enjoyed on their own, they offer both nourishment and a sense of
                                    togetherness. Versatile and deeply flavorful, stews are a comforting classic that
                                    everyone loves.</p>
                                <p class="animate__animated" data-animation="animate__fadeInLeft">Each bowl of stew
                                    tells a story of heritage and love, combining simple ingredients into extraordinary
                                    flavors. Whether rustic and hearty or bold and spiced, stews remain a beloved
                                    favorite, perfect for sharing and savoring.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 order-lg-2 order-1">
                            <div class="sec-img">
                                <img src="assets/images/dish/Dish-4.png" alt="" width="80%" height="80%">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="book-table section bg-light">
                <div class="book-table-shape">
                    <img src="assets/images/table-leaves-shape.png" alt="">
                </div>

                <div class="book-table-shape book-table-shape2">
                    <img src="assets/images/table-leaves-shape.png" alt="">
                </div>

                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">Openings</p>
                                    <h2 class="h2-title animate__animated" data-animation="animate__fadeInUp">Serving
                                        You From</h2>
                                    <div class="sec-title-shape mb-4 animate__animated"
                                        data-animation="animate__fadeInUp">
                                        <img src="assets/images/green-line.png" alt="" width="50%" height="50%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="book-table-info">
                            <div class="row align-items-center">
                                <div class="col-lg-4">
                                    <div class="table-title text-center">
                                        <h3>Monday to Friday</h3>
                                        <p>11:00 am - 12:00 pm</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="call-now text-center">
                                        <i class="uil uil-utensils-alt"></i>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="table-title text-center">
                                        <h3>Saturday to Sunday</h3>
                                        <p>9:00 am to 12:00 pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="gallery">
                            <div class="col-lg-10 m-auto">
                                <div class="book-table-img-slider" id="icon">
                                    <div class="swiper-wrapper">
                                        <a href="assets/images/bt1.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt1.jpg)"></a>
                                        <a href="assets/images/bt2.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt2.jpg)"></a>
                                        <a href="assets/images/bt3.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt3.jpg)"></a>
                                        <a href="assets/images/bt4.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt4.jpg)"></a>
                                        <a href="assets/images/bt1.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt1.jpg)"></a>
                                        <a href="assets/images/bt2.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt2.jpg)"></a>
                                        <a href="assets/images/bt3.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt3.jpg)"></a>
                                        <a href="assets/images/bt4.jpg" data-fancybox="table-slider"
                                            class="book-table-img back-img swiper-slide"
                                            style="background-image: url(assets/images/bt4.jpg)"></a>
                                    </div>

                                    <div class="swiper-button-wp">
                                        <div class="swiper-button-prev swiper-button">
                                            <i class="uil uil-angle-left"></i>
                                        </div>
                                        <div class="swiper-button-next swiper-button">
                                            <i class="uil uil-angle-right"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </section>

            <!-- <section class="our-team section">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">Our Team</p>
                                    <h2 class="h2-title animate__animated" data-animation="animate__fadeInUp">Meet our
                                        Chefs</h2>
                                    <div class="sec-title-shape mb-4 animate__animated"
                                        data-animation="animate__fadeInUp">
                                        <img src="assets/images/green-line.png" alt="" width="50%" height="50%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row team-slider">
                            <div class="swiper-wrapper">
                                <div class="col-lg-4 swiper-slide">
                                    <div class="team-box text-center">
                                        <div style="background-image: url(assets/images/chef/chef-2.jpg); "
                                            class="team-img back-img">

                                        </div>
                                        <h3 class="h3-title">Hrishikesh Kahar</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="mailto:abhijittikone0@gmail.com"><i
                                                            class="uil uil-at"></i></a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/hrishii_111/">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="team-box text-center">
                                        <div style="background-image: url(assets/images/chef/chef-1.jpg); "
                                            class="team-img back-img">

                                        </div>
                                        <h3 class="h3-title">Sujal Hinge</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="mailto:abhijittikone0@gmail.com"><i
                                                            class="uil uil-at"></i></a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/sujal_hinge_patil/">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="team-box text-center">
                                        <div style="background-image: url(assets/images/chef/chef-3.jpg); "
                                            class="team-img back-img">

                                        </div>
                                        <h3 class="h3-title">Shivprasad suryawanshi</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="mailto:abhijittikone0@gmail.com"><i
                                                            class="uil uil-at"></i></a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/shivprasad.suryawanshi967/">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="team-box text-center">
                                        <div style="background-image: url(assets/images/chef/chef-4.jpg); "
                                            class="team-img back-img">

                                        </div>
                                        <h3 class="h3-title">Abhijit Tikone</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="mailto:abhijittikone0@gmail.com"><i
                                                            class="uil uil-at"></i></a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/abhijit_99/">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 swiper-slide">
                                    <div class="team-box text-center">
                                        <div style="background-image: url(assets/images/chef/chef-5.jpg); "
                                            class="team-img back-img">

                                        </div>
                                        <h3 class="h3-title">Sanket Shinde</h3>
                                        <div class="social-icon">
                                            <ul>
                                                <li>
                                                    <a href="mailto:abhijittikone0@gmail.com"><i
                                                            class="uil uil-at"></i></a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/sanketshinde764/">
                                                        <i class="uil uil-instagram"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-wp">
                                <div class="swiper-button-prev swiper-button">
                                    <i class="uil uil-angle-left"></i>
                                </div>
                                <div class="swiper-button-next swiper-button">
                                    <i class="uil uil-angle-right"></i>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </section> -->

            <section class="testimonials section bg-light">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">What their Review</p>
                                    <h2 class="h2-title animate__animated" data-animation="animate__fadeInUp">What our
                                        customers <span>say about us</span></h2>
                                    <div class="sec-title-shape mb-4 animate__animated"
                                        data-animation="animate__fadeInUp">
                                        <img src="assets/images/green-line.png" alt="" width="50%" height="50%">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="testimonial-wrapper animate__animated" data-animation="animate__fadeIn">
                    <div class="testimonial-carousel">
                        <div class="testimonial">
                            <p>"The food was absolutely amazing! Fresh, flavorful, and satisfying."</p>
                            <h4>- John Doe</h4>
                        </div>
                        <div class="testimonial">
                            <p>"Exceptional service and delicious dishes. A wonderful experience I can't wait to
                                repeat!"</p>
                            <h4>- Sarah Lee</h4>
                        </div>
                        <div class="testimonial">
                            <p>"Best food truck ever! The noodles were perfectly cooked and bursting with flavor."</p>
                            <h4>- Mark Smith</h4>
                        </div>
                        <div class="testimonial">
                            <p>"Incredible variety and taste. Every bite was worth it. Five stars for sure!"</p>
                            <h4>- Emma Brown</h4>
                        </div>
                        <div class="testimonial">
                            <p>"Quick service and amazing quality. The ramen is to die for. Keep up the great work!"</p>
                            <h4>- Lucas Green</h4>
                        </div>
                    </div>
                </div>



            </section>



            <?php
            // $host = "localhost";
// $username = "root";
// $password = "abhi879687#";
// $database = "spicymonk";
            
            // $conn = new mysqli($host, $username, $password, $database);
            
            // if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
            include 'db.php';

            $message = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"];
                if (preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) == 0) {
                    $message = "Invalid Email!";
                } else {
                    $stmt = $conn->prepare("SELECT * FROM subscribers WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $message = "You are already subscribed!";
                    } else {
                        $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
                        $stmt->bind_param("s", $email);

                        if ($stmt->execute()) {
                            $message = "Subscription Successful!";
                        } else {
                            $message = "Failed to Subscribe!";
                        }
                    }
                }

                $stmt->close();
            }


            $conn->close();
            ?>

            <div class="bg-pattern bg-light repeat-img"
                style="background-image: url(assets/images/blog-pattern-bg.png);">
                <section class="newsletter-sec section pt-0">
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 m-auto">
                                    <div class="newsletter-box text-center back-img white-text"
                                        style="background-image: url(assets/images/bt3.jpg);">
                                        <div class="bg-overlay dark-overlay"></div>
                                        <div class="sec-wp">
                                            <div class="newsletter-box-text">
                                                <h2 class="h2-title">Subscribe to our newsletter</h2>
                                                <p>Subscribe now to receive updates, offers delivered straight to your
                                                    inbox.</p>
                                            </div>
                                            <form action="" method="POST" class="newsletter-form">
                                                <input type="email" class="form-input" name="email"
                                                    placeholder="Enter your Email Here" required>
                                                <button type="submit" class="sec-btn primary-btn">Submit</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($message))
                        echo "<center><p style='color:green;'>$message</p></center>"; ?>
                </section>
            </div>


            <!-- Footer Start -->
            <div class="footer-5-column">
                <div class="footer-container">
                    <!-- Footer Navigation Start -->
                    <div class="footer-navbar-container">
                        <div class="footer-company-details">
                            <!-- <div class="footer-details-inner"> -->
                            <div class="footer-logo animate__animated" data-animation="animate__flip">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" color="#000" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                </svg>
                            </div>
                            <div class="footer-content">
                                <p>
                                    Taste You Can Trust: From our kitchen to your plate, we promise uncompromised
                                    quality, genuine service, and memorable flavors.
                                </p>
                            </div>
                            <div class="footer-icons">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path
                                                    d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path
                                                    d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path
                                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path
                                                    d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="footer-navbar">
                            <div class="footer-navbar-col">
                                <h5>Solutions</h5>
                                <ul>
                                    <li><a href="#"> FoodCounter </a></li>
                                    <li><a href="#"> Feedback</a></li>
                                    <li><a href="#"> Insight </a></li>
                                    <li><a href="#"> Explore Menu </a></li>
                                </ul>
                            </div>
                            <div class="footer-navbar-col">
                                <h5>Support</h5>
                                <ul>
                                    <li><a href="#"> Home </a></li>
                                    <li><a href="#"> About </a></li>
                                    <li><a href="#"> Contact </a></li>
                                    <li><a href="#"> Location </a></li>
                                </ul>
                            </div>
                            <div class="footer-navbar-col">
                                <h5>Company</h5>
                                <ul>
                                    <li><a href="#"> Terms and Conditions </a></li>
                                    <li><a href="#"> Polices </a></li>
                                    <li><a href="#"> Privacy </a></li>
                                    <li><a href="#"> Insight </a></li>
                                </ul>
                            </div>
                            <div class="footer-navbar-col">
                                <h5>Legal</h5>
                                <ul>
                                    <li><a href="#"> Commerce </a></li>
                                    <li><a href="#"> Analyst </a></li>
                                    <li><a href="#"> Insight </a></li>
                                    <li><a href="#"> Marketing </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Navigation End -->
                    <div class="footer-copyright">
                        <p>© 2025 FoodVan - All Rights Reserved</p>
                    </div>
                </div>
            </div>
            <!-- Footer End-->



        </div>
    </div>



    <!-- Scripts Spicy Monk -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/font-awesome.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery.mixitup.min.js"></script>
    <script src="assets/js/jquery.fancybox.min.js"></script>
    <script src="assets/js/parallax.min.js"></script>
    <script src="assets/js/gsap.min.js"></script>
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <script src="assets/js/ScrollToPlugin.min.js"></script>
    <script src="assets/js/smooth-scroll.js"></script>
    <script src="main.js"></script>


    <script>

        function addToCart(button) {
            // Get the product title
            const productTitle = button.closest(".dish-box").querySelector(".h3-title").textContent.trim();

            // Send product title to the PHP script
            fetch("addToCart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    title: productTitle,
                }),
            })
                .then((response) => response.text())
                .then((data) => {
                    // Show success or error message from PHP
                    window.location.href = "cart.php";
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }




        document.addEventListener("DOMContentLoaded", function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const animationClass = entry.target.getAttribute("data-animation"); // Read the animation class
                        entry.target.classList.add(animationClass);
                    } else {
                        const animationClass = entry.target.getAttribute("data-animation"); // Read the animation class
                        entry.target.classList.remove(animationClass); // Reset animation for re-trigger
                    }
                });
            });

            // Select all elements you want to animate
            const elements = document.querySelectorAll("[data-animation]");
            elements.forEach((el) => observer.observe(el));
        });


    </script>



</body>

</html>