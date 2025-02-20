<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Pacifico&family=Great+Vibes&family=Lobster&family=Satisfy&display=swap" rel="stylesheet">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
     
      body{
    background-image: url('assets/images/faq-bg.png');
    background-size: cover;
    background-position: center;
}

.responsive-container-block {
  min-height: 75px;
  height: fit-content;
  width: 100%;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
  display: flex;
  flex-wrap: wrap;
  margin-top: 10px;
  margin-right: auto;
  margin-bottom: 0px;
  margin-left: auto;
  justify-content: flex-start;

}


a {
  text-decoration-line: none;
  text-decoration-thickness: initial;
  text-decoration-style: initial;
  text-decoration-color: initial;
}

.text-blk {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
  line-height: 25px;
}

.responsive-container-block.bigContainer {
  padding-top: 10px;
  padding-right: 30px;
  padding-bottom: 10px;
  padding-left: 30px;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 10px 50px 10px 50px;
}

.mainImg {
  color: black;
  width: 100%;
  height: auto;
  border-top-left-radius: 17px;
  border-top-right-radius: 17px;
  border-bottom-right-radius: 17px;
  border-bottom-left-radius: 17px;
}

.text-blk.headingText {
  font-size: 39px;
  font-weight: 700;
  line-height: 30px;
  color: rgb(134, 206, 71);
  padding-top: 0px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 0px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 5px;
  margin-left: 0px;
}

.allText {
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  width: 40%;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
}

.text-blk.subHeadingText {
  color: rgb(125, 125, 125);
  font-size: 26px;
  line-height: 32px;
  font-weight: 700;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 15px;
  margin-left: 0px;
  padding-top: 0px;
  padding-right: 10px;
  padding-bottom: 0px;
  padding-left: 0px;
}

.text-blk.description {
  font-size: 18px;
  line-height: 26px;
  color: rgb(125, 125, 125);
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 50px;
  margin-left: 0px;
  font-weight: 400;
  padding-top: 0px;
  padding-right: 10px;
  padding-bottom: 0px;
  padding-left: 0px;
}

.explore {
  font-size: 16px;
  line-height: 28px;
  color: rgb(102, 102, 102);
  border-top-width: 2px;
  border-right-width: 2px;
  border-bottom-width: 2px;
  border-left-width: 2px;
  border-top-style: solid;
  border-right-style: solid;
  border-bottom-style: solid;
  border-left-style: solid;
  border-top-color: rgb(102, 102, 102);
  border-right-color: rgb(102, 102, 102);
  border-bottom-color: rgb(102, 102, 102);
  border-left-color: rgb(102, 102, 102);
  border-image-source: initial;
  border-image-slice: initial;
  border-image-width: initial;
  border-image-outset: initial;
  border-image-repeat: initial;
  cursor: pointer;
  background-color: white;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  padding-top: 8px;
  padding-right: 40px;
  padding-bottom: 8px;
  padding-left: 40px;
  transition: all 0.3s ease 0s;
}

.explore:hover {
  background-image: initial;
  background-position-x: initial;
  background-position-y: initial;
  background-size: initial;
  background-repeat-x: initial;
  background-repeat-y: initial;
  background-attachment: initial;
  background-origin: initial;
  background-clip: initial;
  background-color: rgb(104, 185, 84);
  color: white;
  border-top-width: initial;
  border-right-width: initial;
  border-bottom-width: initial;
  border-left-width: initial;
  border-top-style: none;
  border-right-style: none;
  border-bottom-style: none;
  border-left-style: none;
  border-top-color: initial;
  border-right-color: initial;
  border-bottom-color: initial;
  border-left-color: initial;
  border-image-source: initial;
  border-image-slice: initial;
  border-image-width: initial;
  border-image-outset: initial;
  border-image-repeat: initial;
}

.responsive-container-block.Container {
  margin-top: 80px;
  margin-right: auto;
  margin-bottom: 50px;
  margin-left: auto;
  justify-content: center;
  align-items: center;
  max-width: 1320px;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
}

.responsive-container-block.Container.bottomContainer {
  flex-direction: row-reverse;
  margin-top: 80px;
  margin-right: auto;
  margin-bottom: 50px;
  margin-left: auto;
  position: static;
}

.allText.aboveText {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 40px;
}

.allText.bottomText {
  margin-top: 0px;
  margin-right: 40px;
  margin-bottom: 0px;
  margin-left: 0px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding-top: 0px;
  padding-right: 15px;
  padding-bottom: 0px;
  padding-left: 0px;
}

.purpleBox {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  max-width: 430px;
  background-color: rgb(103, 215, 83);
  padding-top: 20px;
  padding-right: 20px;
  padding-bottom: 20px;
  padding-left: 20px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  position: absolute;
  bottom: -35px;
  left: -8%;
}

.purpleText {
  font-size: 18px;
  line-height: 26px;
  color: white;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 10px;
  margin-left: 0px;
}

.ultimateImg {
  width: 50%;
  position: relative;
}

@media (max-width: 1024px) {
  .responsive-container-block.Container {
    max-width: 850px;
  }

  .mainImg {
    width: 55%;
    height: auto;
  }

  .allText {
    width: 40%;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 20px;
  }

  .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 10px;
    padding-bottom: 10px;
    padding-left: 10px;
  }

  .responsive-container-block.Container.bottomContainer {
    margin-top: 80px;
    margin-right: auto;
    margin-bottom: 50px;
    margin-left: auto;
  }

  .responsive-container-block.Container {
    max-width: 830px;
  }

  .allText.aboveText {
    margin-top: 30px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 40px;
  }

  .allText.bottomText {
    margin-top: 30px;
    margin-right: 40px;
    margin-bottom: 0px;
    margin-left: 0px;
    text-align: left;
  }

  .text-blk.headingText {
    text-align: center;
  }

  .allText.aboveText {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 30px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .text-blk.subHeadingText {
    text-align: left;
    font-size: 26px;
    line-height: 32px;
  }

  .text-blk.description {
    text-align: left;
    line-height: 24px;
  }

  .explore {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 30px;
    padding-bottom: 10px;
    padding-left: 30px;
  }

  .responsive-container-block.Container {
    justify-content: space-evenly;
  }

  .purpleBox {
    bottom: 10%;
  }

  .responsive-container-block.Container.bottomContainer {
    padding-top: 10px;
    padding-right: 0px;
    padding-bottom: 10px;
    padding-left: 0px;
    max-width: 930px;
  }

  .allText.bottomText {
    width: 40%;
  }

  .purpleBox {
    bottom: auto;
    left: -10%;
    top: 70%;
  }

  .mainImg {
    width: 100%;
  }

  .text-blk.headingText {
    text-align: left;
  }
}

@media (max-width: 768px) {
  .allText {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
  }

  .responsive-container-block.Container {
    flex-direction: column;
    height: auto;
  }

  .text-blk.headingText {
    text-align: center;
  }

  .text-blk.subHeadingText {
    text-align: center;
    font-size: 24px;
  }

  .text-blk.description {
    text-align: center;
    font-size: 18px;
  }

  .allText {
    margin-top: 40px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .allText.aboveText {
    margin-top: 40px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .responsive-container-block.Container {
    margin-top: 80px;
    margin-right: auto;
    margin-bottom: 50px;
    margin-left: auto;
  }

  .responsive-container-block.Container.bottomContainer {
    margin-top: 50px;
    margin-right: auto;
    margin-bottom: 50px;
    margin-left: auto;
  }

  .allText.bottomText {
    margin-top: 40px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .mainImg {
    width: 100%;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: -70px;
    margin-left: 0px;
  }

  .responsive-container-block.Container.bottomContainer {
    flex-direction: column;
  }

  .ultimateImg {
    width: 100%;
  }

  .purpleBox {
    position: static;
  }

  .allText.bottomText {
    width: 100%;
    align-items: flex-start;
  }

  .text-blk.headingText {
    text-align: left;
  }

  .text-blk.subHeadingText {
    text-align: left;
  }

  .text-blk.description {
    text-align: left;
  }

  .ultimateImg {
    position: static;
  }

  .mainImg {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .ultimateImg {
    position: relative;
  }

  .purpleBox {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    position: absolute;
    left: 0px;
    top: 80%;
  }

  .allText.bottomText {
    margin-top: 100px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }
}

@media (max-width: 500px) {
  .responsive-container-block.Container {
    padding-top: 10px;
    padding-right: 0px;
    padding-bottom: 10px;
    padding-left: 0px;
    width: 100%;
    max-width: 100%;
  }

  .mainImg {
    width: 100%;
  }

  .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 25px;
    padding-bottom: 10px;
    padding-left: 25px;
  }

  .text-blk.subHeadingText {
    font-size: 24px;
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    line-height: 28px;
  }

  .text-blk.description {
    font-size: 16px;
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    line-height: 22px;
  }

  .allText {
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
    width: 100%;
  }

  .allText.bottomText {
    margin-top: 50px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    padding: 0 0 0 0;
    margin: 30px 0 0 0;
  }

  .ultimateImg {
    position: static;
  }

  .purpleBox {
    position: static;
  }

  .stars {
    width: 55%;
  }

  .allText.bottomText {
    margin-top: 75px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
  }

  .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
  }

  .purpleText {
    font-size: 16px;
    line-height: 22px;
  }

  .explore {
    padding: 6px 35px 6px 35px;
    font-size: 15px;
  }
}

    </style>
</head>
<body>
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

    <br><br>

   
<div class="responsive-container-block bigContainer">
  <div class="responsive-container-block Container bottomContainer">
    <div class="ultimateImg">
      <img class="mainImg" src="assets/images/aboutus-bowl.jpg">
      <div class="purpleBox">
        <p class="purpleText">
        Our passion for food and community drives us to serve the best. From local favorites to unique culinary creations, we strive to make every meal a celebration.
        </p>
        <img class="stars" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/mp5.svg">
      </div>
    </div>
    <div class="allText bottomText">
      <p class="text-blk headingText">
        About Us
      </p>
      <p class="text-blk subHeadingText">
      Delightful flavors crafted with passion, bringing happiness to every moment.
      </p>
      <p class="text-blk description">
      Welcome to our food truck! We bring you freshly prepared meals made from the finest ingredients, right to your doorstep. Our mission is to deliver exceptional flavors while creating memorable dining experiences. From gourmet recipes to innovative dishes, every bite is crafted with care and love.
      <br><br>
      <i class="fa-solid fa-phone-volume"></i> +91 8796873220
    </p>

      <a class="explore">
      Explore Our Menu
      </a>
    </div>
  </div>
</div>


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
