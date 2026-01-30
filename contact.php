<?php
session_start();
if (isset($_SESSION['serch-value-fetch'])) {
    unset($_SESSION['serch-value-fetch']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <style>
        /* Mobile - 360px */
        @media only screen and (min-width: 0rem) {
            #contact-1150 {
                padding: var(--sectionPadding);
                background-color: #f7f7f7;
                position: relative;
                z-index: 1;
            }

            #contact-1150 .cs-container {
                width: 100%;
                /* changes to 1280px at desktop */
                max-width: 44rem;
                margin: auto;
                display: flex;
                justify-content: center;
                align-items: stretch;
                flex-direction: column;
                column-gap: auto;
                /* 48px - 80px */
                row-gap: clamp(3rem, 6vw, 5rem);
                position: relative;
            }

            #contact-1150 .cs-content {
                /* set text align to left if content needs to be left aligned */
                text-align: center;
                width: 100%;
                display: flex;
                flex-direction: column;
                /* centers content horizontally, set to flex-start to left align */
                align-items: center;
                margin-bottom: 20px;
            }

            #contact-1150 .cs-topper {
                color: #767676;
            }

            #contact-1150 .cs-title {
                max-width: 23ch;
                margin: 0;
            }

            #contact-1150 .cs-picture {
                width: 100%;
                /* 240px - 300px */
                height: clamp(15rem, 35vw, 18.75rem);
                margin: 0 0 1.5rem;
                border-radius: 1.5rem;
                /* clips image corners */
                overflow: hidden;
                display: block;
                position: relative;
            }

            #contact-1150 .cs-picture img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                position: absolute;
                top: 0;
                left: 0;
            }

            #contact-1150 .cs-contact-text {
                font-size: 1rem;
                line-height: 1.5em;
                text-align: left;
                margin: 0 0 1.5rem;
                color: var(--bodyTextColor);
            }

            #contact-1150 .cs-ul {
                width: 100%;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
                position: relative;
            }

            #contact-1150 .cs-li {
                list-style: none;
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                gap: 1.25rem;
            }

            #contact-1150 .cs-li:hover .cs-icon-wrapper {
                transform: scale(1.1);
            }

            #contact-1150 .cs-header {
                font-size: 1.25rem;
                font-weight: 700;
                line-height: 1.2em;
                margin-bottom: 0.75rem;
                color: var(--headerColor);
                display: block;
            }

            #contact-1150 .cs-link {
                font-size: 1rem;
                line-height: 1.5em;
                text-decoration: none;
                color: #767676;
                display: block;
                position: relative;
            }

            #contact-1150 .cs-link:hover {
                text-decoration: underline;
            }

            #contact-1150 .cs-icon-wrapper {
                width: 3.75rem;
                height: 3.75rem;
                margin: 0;
                border-radius: 50%;
                border: 1px solid #bababa;
                display: flex;
                justify-content: center;
                align-items: center;
                /* prevents flexbox from squishing it */
                flex: none;
                transition: transform 0.3s;
            }

            #contact-1150 .cs-icon {
                width: 1.5rem;
                height: auto;
                display: block;
            }

            #contact-1150 .cs-form {
                width: 100%;
                /* 24px - 48px top and bottom */
                /* 16px - 32px left and right */
                padding: clamp(1.5rem, 5.18vw, 3rem) clamp(1rem, 4vw, 2rem);
                /* prevents flexbox from affecting height and width */
                box-sizing: border-box;
                background-color: #fff;
                border-radius: 1rem;
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                align-items: center;
                gap: 0.75rem;
            }

            #contact-1150 .cs-label {
                /* 14px - 16px */
                font-size: clamp(0.875rem, 1.5vw, 1rem);
                width: 100%;
                color: var(--headerColor);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: flex-start;
                gap: 0.25rem;
            }

            #contact-1150 .cs-input {
                font-size: 1rem;
                width: 100%;
                height: 3.5rem;
                padding: 0;
                padding-left: 1.5rem;
                color: var(--headerColor);
                background-color: #f7f7f7;
                border-radius: 0.5rem;
                border: none;
                /* prevents padding from adding to height and width */
                box-sizing: border-box;
            }

            #contact-1150 .cs-input::placeholder {
                color: #7d799c;
                opacity: 0.6;
            }

            #contact-1150 .cs-textarea {
                min-height: 7.5rem;
                padding-top: 1.5rem;
                margin-bottom: 0.75rem;
                font-family: inherit;
            }

            #contact-1150 .cs-button-solid {
                font-size: 1rem;
                /* 46px - 56px */
                line-height: clamp(2.875em, 5.5vw, 3.5em);
                text-decoration: none;
                font-weight: 700;
                text-align: center;
                margin: 0;
                color: #1a1a1a;
                border: none;
                min-width: 9.375rem;
                padding: 0 1.5rem;
                background-color: var(--secondary);
                border-radius: 0.25rem;
                overflow: hidden;
                display: inline-block;
                position: relative;
                z-index: 1;
                /* prevents padding from adding to the width */
                box-sizing: border-box;
                transition: color 0.3s;
            }

            #contact-1150 .cs-button-solid:before {
                content: "";
                position: absolute;
                height: 100%;
                width: 0%;
                background: #000;
                opacity: 1;
                top: 0;
                left: 0;
                z-index: -1;
                border-radius: 0.25rem;
                transition: width 0.3s;
            }

            #contact-1150 .cs-button-solid:hover {
                color: #fff;
            }

            #contact-1150 .cs-button-solid:hover:before {
                width: 100%;
            }

            #contact-1150 .cs-submit {
                width: 100%;
                min-width: 17.6875rem;
                border-radius: 0.5rem;
            }

            #contact-1150 .cs-submit:hover {
                cursor: pointer;
            }

            #contact-1150 .cs-graphic {
                display: none;
            }

            #contact-1150 .cs-graphic1 {
                width: 13rem;
                height: auto;
                position: absolute;
                left: -7.5rem;
                top: 8.625rem;
            }

            #contact-1150 .cs-graphic2 {
                width: 12.8125rem;
                height: auto;
                position: absolute;
                right: -9.75rem;
                top: 0.5rem;
            }
        }

        /* Desktop - 1024px */
        @media only screen and (min-width: 64rem) {
            #contact-1150 .cs-container {
                max-width: 80rem;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            #contact-1150 .cs-contact-group {
                width: 50%;
                max-width: 39.375rem;
            }

            #contact-1150 .cs-form {
                width: 46%;
                max-width: 36.125rem;
            }

            #contact-1150 .cs-submit {
                width: auto;
            }
        }

        /* Large Desktop - 1500px */
        @media only screen and (min-width: 93.75rem) {
            #contact-1150 .cs-graphic {
                display: block;
            }
        }


        :root {
            /* Add these styles to your global stylesheet, which is used across all site pages. You only need to do this once. All elements in the library derive their variables and base styles from this central sheet, simplifying site-wide edits. For instance, if you want to modify how your h2's appear across the site, you just update it once in the global styles, and the changes apply everywhere. */
            --primary: rgb(49, 202, 85);
            --primaryLight: rgb(117, 216, 55);
            --secondary: rgb(150, 227, 67);
            --secondaryLight: rgb(98, 231, 68);
            --headerColor: #1a1a1a;
            --bodyTextColor: #4e4b66;
            --bodyTextColorWhite: #fafbfc;
            /* 13px - 16px */
            --topperFontSize: clamp(0.8125rem, 1.6vw, 1rem);
            /* 31px - 49px */
            --headerFontSize: clamp(1.9375rem, 3.9vw, 3.0625rem);
            --bodyFontSize: 1rem;
            /* 60px - 100px top and bottom */
            --sectionPadding: clamp(3.75rem, 7.82vw, 6.25rem) 1rem;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        *,
        *:before,
        *:after {
            /* prevents padding from affecting height and width */
            box-sizing: border-box;
        }

        .cs-topper {
            font-size: var(--topperFontSize);
            line-height: 1.2em;
            text-transform: uppercase;
            text-align: inherit;
            letter-spacing: .1em;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
            display: block;
        }

        .cs-title {
            font-size: var(--headerFontSize);
            font-weight: 900;
            line-height: 1.2em;
            text-align: inherit;
            max-width: 43.75rem;
            margin: 0 0 1rem 0;
            color: var(--headerColor);
            position: relative;
        }

        .cs-text {
            font-size: var(--bodyFontSize);
            line-height: 1.5em;
            text-align: inherit;
            width: 100%;
            max-width: 40.625rem;
            margin: 0;
            color: var(--bodyTextColor);
        }

        .custom-fade-in {
            --animate-fadeInUp-distance: 20px;
            /* Reduce from default 100px to 20px */
        }
    </style>
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
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Pacifico&family=Great+Vibes&family=Lobster&family=Satisfy&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Pacifico&family=Great+Vibes&family=Lobster&family=Satisfy&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <?php
    include 'header.php';
    ?>


    <br><br>
    <section id="contact-1150">
        <div class="cs-container">
            <div class="cs-content animate__animated custom-fade-in" data-animation="animate__fadeInUp">
                <span class="cs-topper">Contact Us</span>
                <h2 class="cs-title">We Love to Hear from Our Happy Customers</h2>
            </div>
            <div class="cs-contact-group">
                <picture class="cs-picture">
                    <!--Mobile Image-->
                    <source media="(max-width: 600px)" srcset="assets/images/bt4.jpg">
                    <!--Tablet and above Image-->
                    <source media="(min-width: 601px)" srcset="assets/images/bt4.jpg">
                    <img loading="lazy" decoding="async" src="assets/images/bt4.jpg" alt="people" width="630"
                        height="300">
                </picture>
                <p class="cs-contact-text">
                    There are many ways to reach us, but the best one is to stop by and taste the flavors yourself!
                    Whether you have questions, feedback, or just want to say hello, we’re here. Find us on the streets,
                    drop us a message, or connect with us on social media.
                </p>
                <ul class="cs-ul">
                    <li class="cs-li">
                        <picture class="cs-icon-wrapper">
                            <img aria-hidden="true"
                                src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Icons/mech-phone.svg"
                                alt="phone icon" class="cs-icon" width="40" height="40" decoding="async">
                        </picture>
                        <div class="cs-flex-group">
                            <span class="cs-header">Phone</span>
                            <a href="tel:+91 7709138858
                        " class="cs-link">+91 7709138858
                            </a>
                        </div>
                    </li>
                    <li class="cs-li">
                        <picture class="cs-icon-wrapper">
                            <img aria-hidden="true"
                                src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Icons/mech-pin.svg"
                                alt="address icon" class="cs-icon" width="40" height="40" decoding="async">
                        </picture>
                        <div class="cs-flex-group">
                            <span class="cs-header">Address</span>
                            <a href="https://maps.app.goo.gl/EZS4t51fUsDTCXXL6" class="cs-link">Ajmera Complex Pimpri , Pune ,
                                Maharashtra</a>
                        </div>
                    </li>
                </ul>
            </div>
            <!--Form-->
            <form class="cs-form" id="cs-form-1150" name="Contact Form" method="post" action="submit_feedback.php">
                <label class="cs-label">
                    Name
                    <input class="cs-input" required type="text" id="name-1150" name="name" placeholder="Name">
                </label>
                <label class="cs-label cs-email">
                    Email
                    <input class="cs-input" required type="email" id="email-1150" name="email" placeholder="Email">
                </label>
                <label class="cs-label cs-phone">
                    Phone
                    <input class="cs-input" required type="number" id="phone-1150" name="phone" placeholder="Phone">
                </label>
                <label class="cs-label">
                    Message
                    <textarea class="cs-input cs-textarea" required name="Message" id="message-1150"
                        placeholder="Write message..."></textarea>
                </label>
                <button class="cs-button-solid cs-submit" type="submit">Submit</button>
            </form>
            <!--Bounce Graphic-->
            <img class="cs-graphic cs-graphic1" loading="lazy" decoding="async"
                src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/MISC/bounce.svg" alt="bounce" width="208"
                height="124">
            <!--Coin Graphic-->
            <img class="cs-graphic cs-graphic2" loading="lazy" decoding="async"
                src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/MISC/coin.svg" alt="bounce" width="205"
                height="161">
        </div>
    </section>

    <?php
    include 'notification.php';
    if (isset($_SESSION['feedback']) && isset($_SESSION['feedback_message'])) {
        if ($_SESSION['feedback'] == true) {
            showNotification("Success!", $_SESSION['feedback_message']);
        } else {
            showNotification("Failed!", $_SESSION['feedback_message']);
        }
        unset($_SESSION['feedback']);
        unset($_SESSION['feedback_message']);
    }

    ?>

    <!-- Footer Start -->
    <div class="footer-5-column">
        <div class="footer-container">
            <!-- Footer Navigation Start -->
            <div class="footer-navbar-container">
                <div class="footer-company-details">
                    <!-- <div class="footer-details-inner"> -->
                    <div class="footer-logo">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" color="#000" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                    </div>
                    <div class="footer-content">
                        <p>
                            Taste You Can Trust: From our kitchen to your plate, we promise uncompromised quality,
                            genuine service, and memorable flavors.
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