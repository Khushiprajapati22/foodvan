<?php
// Database connection
$host = "localhost"; 
$username = "root";
$password = "abhi879687#";
$database = "spicymonk"; 

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if(isset($_GET['search-result'])){
    if($_GET['search-result']!==""){

        $stmt = $conn->prepare("SELECT * FROM products WHERE title LIKE ?");
        $searchValue = '%'.$_GET['search-result'] . '%'; 
        $stmt->bind_param("s", $searchValue);
        $stmt->execute();
        
    }else{
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
    }

    $result = $stmt->get_result();
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpicyMonk</title>
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
<style>
.product-section {
  padding: 20px;
  position: relative;
  /* background-color: #e3f4e8; */
  border-radius: 10px;
}

.product-container {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.product-cards {
  display: flex;
  gap: 20px;
  overflow-x: scroll;
  scroll-behavior: smooth;
  width: 80%;
  padding: 10px 0;
}

.product-card {
  flex: 0 0 calc(20% - 20px); /* Show 5 cards at a time */
  max-width: 200px;
  background: #e3f4e8;
  /* border: 1px solid #b2d8c6; */
  border-radius: 10px;
  padding: 15px;
  text-align: center;
  box-shadow: 0 4px 8px rgba(30, 30, 30, 0.1);
  transition: transform 0.3s;
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-card i {
  font-size: 40px;
  color: #09b344;
  margin-bottom: 10px;
}

.product-card h3 {
    display: block;
  font-size: 16px;
  font-weight: 600;
  color: #09b344;
  margin-bottom: 10px;
}

.product-card p {
  font-size: 14px;
  color: #555;
  margin-bottom: 15px;
}

.add-to-cart {
  background: #09b344;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
}

.add-to-cart:hover {
  background: #086f29;
}

.scroll-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: #09b344;
  color: white;
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  font-size: 20px;
  cursor: pointer;
  z-index: 10; /* Ensures the buttons are above the cards */
}

.scroll-btn.left-btn {
  left: 10px;
}

.scroll-btn.right-btn {
  right: 10px;
}


.product-cards::-webkit-scrollbar {
  display: none;
}

@media (max-width: 768px) {
  .product-card {
    flex: 0 0 calc(100%-20px); /* Show 2 cards on smaller screens */
  }

  .product-card i {
    font-size: 30px;
  }

  .product-card h3 {
    font-size: 16px;
  }S

  .product-card p {
    font-size: 12px;
  }

  .add-to-cart {
    font-size: 12px;
  }
}

</style>
</head>

<body class="body-fixed">
    <header class="site-header">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.html">
                            <img src="spicymonk-logo.png" width="160" height="36" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="#menu">Menu</a></li>
                                <li><a href="location.php">Location</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="#">Cart</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-right">
                            <form action="menu.php" method="GET" class="header-search-form for-des">
                                <input type="search" name="search-result" class="form-input" placeholder="Search product...">
                                <button type="submit">
                                    <i class="uil uil-search"></i>
                                </button>
                            </form>
                            <a href="javascript:void(0)" class="header-btn header-cart">
                                <i class="uil uil-shopping-bag"></i>
                                <span class="cart-number">3</span>
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

   


            <section style="background-image: url(assets/images/menu-bg.png);"
                class="our-menu section bg-light repeat-img" id="menu">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">our menu</p>
                                    <h2 class="h2-title">Early mornings, <span>fresh meals & healthy vibe</span></h2>
                                    <div class="sec-title-shape mb-4">
                                        <img src="assets/images/green-line.png" alt="" width="50%" height="50%">
                                    </div>
                                </div>
                            </div>
                        </div>
               
                        <section class="product-section">
  <div class="product-container">
    <button class="scroll-btn left-btn" onclick="scrolllefting()">&lt;</button>
    <div class="product-cards" id="productScroll">
      <?php

      // Fetch categories from the database
      $sql = "SELECT title FROM category";
      $result = $conn->query($sql);

      // Check if any categories exist
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '
              <div class="product-card" onclick="categoryload(this)">
                <i class="fas fa-utensils"></i>
                <h3>' . htmlspecialchars($row['title']) . '</h3>
              </div>
              ';
          }
      } else {
          echo "<p>No categories available.</p>";
      }

      ?>
    </div>
    <button class="scroll-btn right-btn" onclick="scrollRight()">&gt;</button>
  </div>
</section>


<script>
  function categoryload(card) {
    const cardValue = card.querySelector('h3').innerText; // Get the text inside the <h3>

    // Redirect to the PHP file with the card value as a query parameter
    window.location.href = `menu.php?cardValue=${encodeURIComponent(cardValue)}`;
  }
</script>

<?php
    
    if(isset($_GET['search-result'])){
        if($_GET['search-result']!==""){
    
            $stmt = $conn->prepare("SELECT * FROM products WHERE title LIKE ?");
            $searchValue = '%'.$_GET['search-result'] . '%'; 
            $stmt->bind_param("s", $searchValue);
            $stmt->execute();
            
        }else{
            $stmt = $conn->prepare("SELECT * FROM products");
            $stmt->execute();
        }
    
        $result = $stmt->get_result();
        
    }else{

        $stmt = $conn->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->get_result();

    }

    if (isset($_GET['cardValue'])) {
    
        $cardValue = $_GET['cardValue'];


        if($cardValue=="All Menus"){
            $stmt = $conn->prepare("SELECT * FROM products");
            $stmt->execute();
            
        }else{

        // Use prepared statements for safety
        $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
        $stmt->bind_param("s", $cardValue);
        $stmt->execute();
     
        }
    
        // Fetch the results
        $result = $stmt->get_result();
    
        // Debugging: Log the query (optional, for testing purposes)
    
    
    }
?>




                        <div class="menu-tab-wp">
                            <div class="row">
                                <div class="col-lg-12 m-auto">
                                </div>
                            </div>
                        </div>
                        <div class="menu-list-row">
                            <div class="row g-xxl-5 bydefault_show" id="menu-dish">

                            <?php
                // Loop through each product and display it
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-4 col-sm-6 dish-box-wp <?php echo htmlspecialchars($row['category']); ?>" data-cat="<?php echo htmlspecialchars($row['category']); ?>">
                            <div class="dish-box text-center">
                                <div class="dist-img">
                                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" height="85%" width="85%">
                                </div>
                                <div class="dish-rating">
                                    <?php echo htmlspecialchars($row['rating']); ?>
                                    <i class="uil uil-star"></i>
                                </div>
                                <div class="dish-title">
                                    <h3 class="h3-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                                </div>
                                <div class="dish-info">
                                    <ul>
                                        <li>
                                            <p>Type</p>
                                            <b><?php echo htmlspecialchars($row['type']); ?></b>
                                        </li>
                                        <li>
                                            <p>Persons</p>
                                            <b><?php echo htmlspecialchars($row['persons']); ?></b>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dist-bottom-row">
                                    <ul>
                                        <li>
                                            <b>Rs. <?php echo htmlspecialchars($row['price']); ?></b>
                                        </li>
                                        <li>
                                            <button class="dish-add-btn" onclick="alert('hello')">
                                                <i class="uil uil-plus"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p style='position:absolute; left:640px;'><i class='fa-solid fa-seedling'></i> No products available</p>";
                }
                $conn->close();
                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </section>

            


           <!-- Footer Start -->
<div class="footer-5-column">
    <div class="footer-container">
      <!-- Footer Navigation Start -->
      <div class="footer-navbar-container">
        <div class="footer-company-details">
          <!-- <div class="footer-details-inner"> -->
          <div class="footer-logo">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" color="#000" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
            </svg>
          </div>
          <div class="footer-content">
            <p>
                Taste You Can Trust: From our kitchen to your plate, we promise uncompromised quality, genuine service, and memorable flavors.
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
        <p>© 2025 SpicyMonk - All Rights Reserved</p>
      </div>
    </div>
  </div>
  <!-- Footer End-->



        </div>
    </div>

<script>
const scrollContainer = document.getElementById('productScroll');


function scrollRight() {
  scrollContainer.scrollBy({ left: 300, behavior: 'smooth' }); // Smooth scroll right
}

function scrolllefting() {
  scrollContainer.scrollBy({ left: -300, behavior: 'smooth' }); // Smooth scroll right
}

</script>

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

    

</body>

</html>