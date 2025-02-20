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