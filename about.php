<?php
session_start();
?>

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

/* Mobile - 360px */
@media only screen and (min-width: 0rem) {
    #services-296 {
        padding: var(--sectionPadding);
    }
    #services-296 .cs-container {
        width: 100%;
        /* changes to 1440px on desktop */
        max-width: 43.75rem;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* 48px - 64px */
        gap: clamp(3rem, 6vw, 4rem);
    }
    #services-296 .cs-content {
        /* set text align to left if content needs to be left aligned */
        text-align: center;
        width: 100%;
        display: flex;
        flex-direction: column;
        /* centers content horizontally, set to flex-start to left align */
        align-items: center;
    }

    #services-296 .cs-title {
        max-width: 30ch;
    }
    #services-296 .cs-card-group {
        width: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        /* 16px - 20px */
        gap: clamp(1rem, 1.5vw, 1.25rem);
    }
    #services-296 .cs-item {
        list-style: none;
        text-align: left;
        width: 100%;
        margin: 0;
        padding: 2rem;
        background-color: #f7f7f7;
        border-radius: 1rem;
        /* clips image corners */
        overflow: hidden;
        /* prevents padding from adding to height and width */
        box-sizing: border-box;
        position: relative;
        z-index: 1;
        transition: background-color 0.3s;
    }
    #services-296 .cs-item:hover {
        cursor: pointer;
    }
    #services-296 .cs-item:hover .cs-image {
        opacity: 1;
    }
    #services-296 .cs-item:hover .cs-image img {
        transform: scale(1.1);
    }
    #services-296 .cs-item:hover .cs-icon {
        /* turns it white */
        filter: grayscale(1) brightness(1000%);
    }
    #services-296 .cs-item:hover .cs-h3,
    #services-296 .cs-item:hover .cs-item-text {
        color: #fff;
    }
    #services-296 .cs-image {
        width: 100%;
        height: 100%;
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        z-index: -1;
        background-color: var(--primary);
        transition: opacity 0.3s;
    }
    #services-296 .cs-image img {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        opacity: 0.4;
        object-fit: cover;
        transition: transform 0.6s;
    }
    #services-296 .cs-link {
        text-decoration: none;
    }
    #services-296 .cs-icon {
        width: auto;
        height: 3rem;
        margin-bottom: 1.5rem;
        display: block;
    }
    #services-296 .cs-icon path {
        transition: fill 0.3s;
    }
    #services-296 .cs-h3 {
        /* 20px - 25px */
        font-size: clamp(1.25rem, 2vw, 1.5625rem);
        line-height: 1.2em;
        margin: 0;
        margin-bottom: 1rem;
        color: var(--headerColor);
        transition: color 0.3s;
        font-weight: bold;
    }
    #services-296 .cs-item-text {
        font-size: 1rem;
        line-height: 1.5em;
        margin: 0;
        color: var(--bodyTextColor);
        transition: color 0.3s;
    }
}
/* Tablet - 768px */
@media only screen and (min-width: 48rem) {
    #services-296 .cs-card-group {
        justify-content: space-between;
        /* makes sure every box "stretches" to be the same height as the tallest box */
        align-items: stretch;
        flex-direction: row;
        flex-wrap: wrap;
    }
    #services-296 .cs-item {
        width: 48.6%;
    }
}
/* Desktop - 1300px */
@media only screen and (min-width: 81.25rem) {
    #services-296 .cs-container {
        max-width: 90rem;
    }
    #services-296 .cs-card-group {
        justify-content: center;
    }
    #services-296 .cs-item {
        /* we do this so it's stackable. You can add new any number of reviews you want and they will stack and center in the middle. We dont use grid because if you have an odd number of reviews, they don't stay centered.  They align with their grid lines. If you want 4 reviews in a row, lower the width under 22.5vw or 23% to get the desired sizes fit 4 in a row and then stack when you add more */
        width: clamp(23.84%, 22.5vw, 23.95%);
    }
}

:root {
    /* Add these styles to your global stylesheet, which is used across all site pages. You only need to do this once. All elements in the library derive their variables and base styles from this central sheet, simplifying site-wide edits. For instance, if you want to modify how your h2's appear across the site, you just update it once in the global styles, and the changes apply everywhere. */
    --primary:rgb(49, 202, 85);
    --primaryLight:rgb(117, 216, 55);
    --secondary:rgb(150, 227, 67);
    --secondaryLight:rgb(98, 231, 68);
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

*, *:before, *:after {
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
    margin-top:10px;
}
         
/*-- -------------------------- -->
<---         Services           -->
<--- -------------------------- -*/

/* Mobile - 360px */
@media only screen and (min-width: 0rem) {
  #services-1121 {
    padding: var(--sectionPadding);
    background-color: #1a1a1a;
    position: relative;
    z-index: 1;
  }
  #services-1121 .cs-container {
    width: 100%;
    max-width: 80rem;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* 48px - 64px */
    gap: clamp(3rem, 6vw, 4rem);
  }
  #services-1121 .cs-card-group {
    width: 100%;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* changes to a clamp on tablet */
    gap: 2.5rem;
  }
  #services-1121 .cs-item {
    text-align: center;
    list-style: none;
    width: 100%;
    max-width: 25.8125rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    /* 16px - 24px */
    gap: clamp(1rem, 3vw, 1.5rem);
  }
  #services-1121 .cs-image-group {
    /* 80px - 100px */
    width: clamp(5rem, 8vw, 6.25rem);
    height: clamp(5rem, 8vw, 6.25rem);
    display: flex;
    justify-content: center;
    align-items: center;
    /* prevents flexbox from squishing it */
    flex: none;
    position: relative;
    z-index: 1;
  }
  #services-1121 .cs-icon {
    /* 36px - 48px */
    width: clamp(2.25rem, 4vw, 3rem);
    height: auto;
  }
  #services-1121 .cs-graphic {
    width: 100%;
    height: auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
  }
  #services-1121 .cs-h2 {
    /* 20px - 25px */
    font-size: clamp(1.25rem, 2.5vw, 1.5625rem);
    line-height: 1.2em;
    font-weight: 700;
    text-align: inherit;
    margin: 0 0 0.75rem;
    color: var(--bodyTextColorWhite);
  }
  #services-1121 .cs-item-text {
    font-size: 1rem;
    line-height: 1.5em;
    text-align: inherit;
    margin: 0;
    color: var(--bodyTextColorWhite);
  }
  #services-1121 .cs-waves {
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    /* makes it act like a background image */
    object-fit: cover;
    position: absolute;
    z-index: -1;
  }
}
/* Tablet - 768px */
@media only screen and (min-width: 48rem) {
  #services-1121 .cs-card-group {
    flex-direction: row;
    justify-content: space-between;
    align-items: stretch;
    /* 16px - 20px */
    gap: clamp(1rem, 2.5vw, 1.25rem);
  }
}
/* Small Desktop - 1024px */
@media only screen and (min-width: 64rem) {
  #services-1121 .cs-item {
    text-align: left;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
  }
}


*, *:before, *:after {
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
          
/*-- -------------------------- -->
<---            FAQ             -->
<--- -------------------------- -*/

/* Mobile - 360px */
@media only screen and (min-width: 0rem) {
    #faq-350 {
        padding: var(--sectionPadding);
        background: #f7f7f7;
    }
    #faq-350 .cs-container {
        width: 100%;
        /* changes to 1280px at desktop */
        max-width: 34.375rem;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* 40px - 48px */
        gap: clamp(2.5rem, 5vw, 3rem);
    }
    #faq-350 .cs-content {
        /* set text align to left if content needs to be left aligned */
        text-align: left;
        width: 100%;
        max-width: 32.625rem;
        display: flex;
        flex-direction: column;
        /* centers content horizontally, set to flex-start to left align */
        align-items: flex-start;
    }

    #faq-350 .cs-title {
        margin: 0 0 2rem 0;
    }
    #faq-350 .cs-faq-group {
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    #faq-350 .cs-faq-item {
        list-style: none;
        width: 100%;
        border-bottom: 1px solid #e8e8e8;
        transition: border-bottom 0.3s;
    }
    #faq-350 .cs-faq-item.active {
        border-color: var(--primaryLight);
    }
    #faq-350 .cs-faq-item.active .cs-button:before {
        background-color: var(--primaryLight);
        transform: rotate(315deg);
    }
    #faq-350 .cs-faq-item.active .cs-button:after {
        background-color: var(--primaryLight);
        transform: rotate(-315deg);
    }
    #faq-350 .cs-faq-item.active .cs-item-p {
        height: auto;
        /* 20px - 24px bottom */
        /* 16px - 24px left & right */
        padding: 0 clamp(1rem, 2vw, 1.5rem) clamp(1.25rem, 1.3vw, 1.5rem);
        opacity: 1;
    }
    #faq-350 .cs-button {
        font-size: 1rem;
        line-height: 1.2em;
        text-align: left;
        font-weight: bold;
        /* 16px - 20px */
        padding: clamp(1rem, 1.3vw, 1.25rem);
        border: none;
        background: transparent;
        color: var(--headerColor);
        display: block;
        width: 100%;
        position: relative;
        transition:
            background-color 0.3s,
            color 0.3s;
    }
    #faq-350 .cs-button:hover {
        cursor: pointer;
    }
    #faq-350 .cs-button:before {
        /* left line */
        content: "";
        width: 0.5rem;
        height: 0.125rem;
        background-color: var(--headerColor);
        opacity: 1;
        border-radius: 50%;
        position: absolute;
        display: block;
        top: 45%;
        right: 1.5rem;
        transform: rotate(45deg);
        /* animate the transform from the left side of the x axis, and the center of the y */
        transform-origin: left center;
        transition: transform 0.5s;
    }
    #faq-350 .cs-button:after {
        /* right line */
        content: "";
        width: 0.5rem;
        height: 0.125rem;
        background-color: var(--headerColor);
        opacity: 1;
        border-radius: 50%;
        position: absolute;
        display: block;
        top: 45%;
        right: 1.3125rem;
        transform: rotate(-45deg);
        /* animate the transform from the right side of the x axis, and the center of the y */
        transform-origin: right center;
        transition: transform 0.5s;
    }
    #faq-350 .cs-button-text {
        width: 80%;
        display: block;
    }
    #faq-350 .cs-item-p {
        /* 14px - 16px */
        font-size: clamp(0.875rem, 1.5vw, 1rem);
        line-height: 1.5em;
        width: 90%;
        height: 0;
        margin: 0;
        /* 16px - 24px */
        padding: 0 clamp(1rem, 2vw, 1.5rem);
        opacity: 0;
        color: var(--bodyTextColor);
        /* clips the text so it doesn't show up */
        overflow: hidden;
        transition:
            opacity 0.3s,
            padding-bottom 0.3s;
    }
    #faq-350 .cs-left {
        /* scaling entire section down. font-size starts at a min in vw, and stops
               when that value reaches 1em (16px). Since we want the picture elements to base their
               font size on the parent and not the root, we use ems for this entire section  */
        font-size: min(2.08vw, 0.791em);
        width: 42.875em;
        height: 42em;
        position: relative;
        /* flips it horizontally */
        transform: scaleX(-1);
    }
    @keyframes floatAnimation {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-2em);
        }
        100% {
            transform: translateY(0);
        }
    }
    @keyframes floatAnimation2 {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-1em);
        }
        100% {
            transform: translateY(0);
        }
    }
    #faq-350 .cs-left:before {
        /* blue circle */
        content: "";
        width: 7.5em;
        height: 7.5em;
        border-radius: 50%;
        background: var(--secondary);
        opacity: 1;
        position: absolute;
        display: block;
        bottom: 6.25em;
        left: 0em;
        z-index: 10;
        animation-name: floatAnimation;
        animation-duration: 6s;
        animation-timing-function: ease-in-out;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
    }
    #faq-350 .cs-picture {
        border-radius: 50%;
        /* border: clamp(6px, 1.2vw, 12px) solid #ffffff; */
        /* clips the img tag corners */
        overflow: hidden;
        position: absolute;
        display: block;
    }
    #faq-350 .cs-picture img {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    #faq-350 .cs-picture1 {
        width: 42em;
        height: 42em;
        top: -0.75em;
        left: -0.75em;
    }
    #faq-350 .cs-picture2 {
        width: 12.5em;
        height: 12.5em;
        top: -0.75em;
        left: -0.75em;
        animation-name: floatAnimation2;
        animation-duration: 20s;
        animation-timing-function: ease-in-out;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
    }
    #faq-350 .cs-picture3 {
        width: 18.75em;
        height: 18.75em;
        bottom: -0.75em;
        right: -0.75em;
        animation-name: floatAnimation;
        animation-duration: 13s;
        animation-delay: 1s;
        animation-timing-function: ease-in-out;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
    }
}
/* Desktop - 1024px */
@media only screen and (min-width: 64rem) {
    #faq-350 .cs-container {
        max-width: 80rem;
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-start;
        gap: 3.25rem;
    }
    #faq-350 .cs-left {
        /* reset the scale */
        font-size: min(1vw, 1em);
        /* prevents flexbox from squishing it */
        flex: none;
        /* sends it to the right in the 2nd position */
        order: 2;
    }
    #faq-350 .cs-title,
    #faq-350 .cs-topper {
        text-align: left;
        width: 80%;
        margin-left: 0;
    }
}



*, *:before, *:after {
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
                            

                                

    </style>
</head>
<body>
<?php
include 'header.php';
?>

    <br><br>

<section id="services-296">
    <div class="cs-container">
        <div class="cs-content">
            <span class="cs-topper animate__animated "  data-animation="animate__fadeInUp">About Us</span>
            <h2 class="cs-title animate__animated animate__delay-0.5s "  data-animation="animate__fadeInUp">We Are Committed To Delivering Top Quality Food Services</h2>
            <br>
            <p class="cs-text animate__animated animate__delay-1s"  data-animation="animate__fadeInUp">
            At SpicyMonk, we bring the flavors of the streets to your plate with our vibrant food truck experience.   </p>
         </div>
        <ul class="cs-card-group">
            <li class="cs-item">
              
                <i class="fa-solid fa-seedling fa-lg" style="color: #000000;"></i>
                    <h3 class="cs-h3">Fresh & Authentic Flavors</h3>
                    <p class="cs-item-text">
                    We use the finest ingredients to create mouth-watering dishes that capture the essence of street food.
                    </p>
                
                <picture class="cs-image"  aria-hidden="true">
                    <source media="(max-width: 600px)" srcset="assets/images/bt1.jpg">
                    <source media="(min-width: 601px)" srcset="assets/images/bt1.jpg">
                    <img loading="lazy" decoding="async" src="assets/images/bt1.jpg" alt="library" width="413" height="266">
                </picture>
            </li>
            <li class="cs-item">
              
                <i class="fa-solid fa-seedling fa-lg" style="color: #000000;"></i>
                    <h3 class="cs-h3">Fast & Friendly Service</h3>
                    <p class="cs-item-text">
                        FEnjoy great food with quick and efficient service, ensuring you get your meal hot and fresh.
                    </p>
            
                <picture class="cs-image"  aria-hidden="true">
                    <source media="(max-width: 600px)" srcset="assets/images/bt1.jpg">
                    <source media="(min-width: 601px)" srcset="assets/images/bt1.jpg">
                    <img loading="lazy" decoding="async" src="assets/images/bt1.jpg" alt="library" width="413" height="266">
                </picture>
            </li>
            <li class="cs-item">
             
                <i class="fa-solid fa-seedling fa-lg" style="color: #000000;"></i>
                    <h3 class="cs-h3">Hygienic & Quality Standards</h3>
                    <p class="cs-item-text">
                    We prioritize hygiene and quality to ensure a safe and enjoyable dining experience for every customer.
                  </p>
                
                <picture class="cs-image"  aria-hidden="true">
                    <source media="(max-width: 600px)" srcset="assets/images/bt1.jpg">
                    <source media="(min-width: 601px)" srcset="assets/images/bt1.jpg">
                    <img loading="lazy" decoding="async" src="assets/images/bt1.jpg" alt="library" width="413" height="266">
                </picture>
            </li>
            <li class="cs-item">
            
                <i class="fa-solid fa-seedling fa-lg" style="color: #000000;"></i>
                    <h3 class="cs-h3">On-the-Go Convenience</h3>
                    <p class="cs-item-text">
                    Find us at various locations, bringing delicious meals straight to your neighborhood.
                  </p>
             
                <picture class="cs-image">
                    <source media="(max-width: 600px)" srcset="assets/images/bt1.jpg">
                    <source media="(min-width: 601px)" srcset="assets/images/bt1.jpg">
                    <img loading="lazy" decoding="async" src="assets/images/bt1.jpg" alt="library" width="413" height="266" aria-hidden="true">
                </picture>
            </li>
        </ul>
    </div>
</section>
                        
<section id="faq-350">
    <div class="cs-container">
        <div class="cs-left">
            <!--Big Image-->
            <picture class="cs-picture cs-picture1" aria-hidden="true">
                <source media="(max-width: 600px)" srcset="assets/images/main-b.jpg">
                <source media="(min-width: 601px)" srcset="assets/images/main-b.jpg">
                <img loading="lazy" decoding="async" src="assets/images/main-b.jpg" alt="SpicyMonk Food Truck" width="672" height="672">
            </picture>
            <!--Medium Image-->
            <picture class="cs-picture cs-picture2" aria-hidden="true">
                <source media="(max-width: 600px)" srcset="assets/images/bt1.jpg">
                <source media="(min-width: 601px)" srcset="assets/images/bt1.jpg">
                <img loading="lazy" decoding="async" src="assets/images/bt1.jpg" alt="Delicious Pizza" width="300" height="300">
            </picture>
            <!--Small Image-->
            <picture class="cs-picture cs-picture3" aria-hidden="true">
                <source media="(max-width: 600px)" srcset="assets/images/bt4.jpg">
                <source media="(min-width: 601px)" srcset="assets/images/bt4.jpg">
                <img loading="lazy" decoding="async" src="assets/images/bt4.jpg" alt="Fresh Sushi" width="200" height="200">
            </picture>
        </div>
        <div class="cs-content">
            <span class="cs-topper">Asked Questions</span>
            <h2 class="cs-title">Frequently Asked Questions</h2>
            <ul class="cs-faq-group">
                <!-- Active class added as default -->
                <li class="cs-faq-item active">
                    <button class="cs-button">
                        <span class="cs-button-text">
                            Where is SpicyMonk food truck located?
                        </span>
                    </button>
                    <p class="cs-item-p">
                        Our food truck moves around! Follow us on social media or check our website to see our current location and schedule.
                    </p>
                </li>
                <li class="cs-faq-item">
                    <button class="cs-button">
                        <span class="cs-button-text">
                            What type of food do you serve?
                        </span>
                    </button>
                    <p class="cs-item-p">
                        We specialize in spicy, flavorful street food, including delicious wraps, tacos, and fusion dishes made with fresh ingredients.
                    </p>
                </li>
                <li class="cs-faq-item">
                    <button class="cs-button">
                        <span class="cs-button-text">
                            Do you offer vegetarian or vegan options?
                        </span>
                    </button>
                    <p class="cs-item-p">
                        Yes! We have a variety of vegetarian and vegan options to ensure everyone can enjoy our flavors.
                    </p>
                </li>
                <li class="cs-faq-item">
                    <button class="cs-button">
                        <span class="cs-button-text">
                            Can I pre-order food for pickup?
                        </span>
                    </button>
                    <p class="cs-item-p">
                        Absolutely! You can place your order online or call ahead, and we’ll have it ready for you at our next stop.
                    </p>
                </li>
                <li class="cs-faq-item">
                    <button class="cs-button">
                        <span class="cs-button-text">
                            Do you cater for events?
                        </span>
                    </button>
                    <p class="cs-item-p">
                        Yes, we offer catering services for parties, corporate events, and special occasions. Contact us for details!
                    </p>
                </li>
            </ul>
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

        const faqItems = Array.from(document.querySelectorAll('.cs-faq-item'));
        for (const item of faqItems) {
            const onClick = () => {
            item.classList.toggle('active')
        }
        item.addEventListener('click', onClick)
        }
                                
            </script>
</body>
</html>
