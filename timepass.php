<?php
// Include database connection
require_once 'db.php';

$notification = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $notification = "Subscription Successful!";
    } else {
        $notification = "Failed to Subscribe!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Subscription</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }

        .notification-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .notification-card {
            background: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: fadeIn 0.5s ease-in-out;
        }

        .notification-card.success {
            border-left: 5px solid #28a745;
        }

        .notification-card.fail {
            border-left: 5px solid #dc3545;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            margin-top: 10px;
            color: #333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }
    </style>
</head>
<body>

<div class="bg-pattern bg-light repeat-img" style="background-image: url(assets/images/blog-pattern-bg.png);">
    <section class="newsletter-sec section pt-0">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="newsletter-box text-center back-img white-text" style="background-image: url(assets/images/bt3.jpg);">
                            <div class="bg-overlay dark-overlay"></div>
                            <div class="sec-wp">
                                <div class="newsletter-box-text">
                                    <h2 class="h2-title">Subscribe to our newsletter</h2>
                                    <p>Subscribe now to receive updates, offers delivered straight to your inbox.</p>
                                </div>
                                <form action="" method="POST" class="newsletter-form">
                                    <input type="email" class="form-input" name="email" placeholder="Enter your Email Here" required>
                                    <button type="submit" class="sec-btn primary-btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="bg-pattern bg-light repeat-img" style="background-image: url(assets/images/blog-pattern-bg.png);">
    <section class="newsletter-sec section pt-0">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="newsletter-box text-center back-img white-text" style="background-image: url(assets/images/bt3.jpg);">
                            <div class="bg-overlay dark-overlay"></div>
                            <div class="sec-wp">
                                <div class="newsletter-box-text">
                                    <h2 class="h2-title">Subscribe to our newsletter</h2>
                                    <p>Subscribe now to receive updates, offers delivered straight to your inbox.</p>
                                </div>
                                <form action="" method="POST" class="newsletter-form">
                                    <input type="email" class="form-input" name="email" placeholder="Enter your Email Here" required>
                                    <button type="submit" class="sec-btn primary-btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="bg-pattern bg-light repeat-img" style="background-image: url(assets/images/blog-pattern-bg.png);">
    <section class="newsletter-sec section pt-0">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="newsletter-box text-center back-img white-text" style="background-image: url(assets/images/bt3.jpg);">
                            <div class="bg-overlay dark-overlay"></div>
                            <div class="sec-wp">
                                <div class="newsletter-box-text">
                                    <h2 class="h2-title">Subscribe to our newsletter</h2>
                                    <p>Subscribe now to receive updates, offers delivered straight to your inbox.</p>
                                </div>
                                <form action="" method="POST" class="newsletter-form">
                                    <input type="email" class="form-input" name="email" placeholder="Enter your Email Here" required>
                                    <button type="submit" class="sec-btn primary-btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="bg-pattern bg-light repeat-img" style="background-image: url(assets/images/blog-pattern-bg.png);">
    <section class="newsletter-sec section pt-0">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="newsletter-box text-center back-img white-text" style="background-image: url(assets/images/bt3.jpg);">
                            <div class="bg-overlay dark-overlay"></div>
                            <div class="sec-wp">
                                <div class="newsletter-box-text">
                                    <h2 class="h2-title">Subscribe to our newsletter</h2>
                                    <p>Subscribe now to receive updates, offers delivered straight to your inbox.</p>
                                </div>
                                <form action="" method="POST" class="newsletter-form">
                                    <input type="email" class="form-input" name="email" placeholder="Enter your Email Here" required>
                                    <button type="submit" class="sec-btn primary-btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Notification Overlay (Always Fixed in Center) -->
<div class="notification-overlay" id="notification">
    <div class="notification-card" id="notification-card">
        <p id="notification-text"></p>
        <button class="close-btn" onclick="closeNotification()">OK</button>
    </div>
</div>

<script>
    function showNotification(message, type) {
        document.getElementById("notification-text").innerText = message;
        let card = document.getElementById("notification-card");

        if (type === "success") {
            card.classList.add("success");
        } else {
            card.classList.add("fail");
        }

        document.getElementById("notification").style.display = "flex";
    }

    function closeNotification() {
        document.getElementById("notification").style.display = "none";
    }

    <?php if (!empty($notification)) { ?>
        showNotification("<?php echo $notification; ?>", "<?php echo ($notification == 'Subscription Successful!') ? 'success' : 'fail'; ?>");
    <?php } ?>
</script>

</body>
</html>
