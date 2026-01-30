<?php
include 'notification.php';

session_start();
if (isset($_SESSION['serch-value-fetch'])) {
  unset($_SESSION['serch-value-fetch']);
}
if ($_SESSION['tick'] == false) {
  header("Location: index.php");
  exit();
}
// Include database connection
require_once 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['useremail'])) {
  // If the session variable is not set, redirect the user to the login page
  header("Location: loginauth.php");
  exit();
}

$email = $_SESSION['useremail'];

// Debugging email in the session
echo "<script>console.log('Session email: " . $email . "');</script>";

$email = $_SESSION['useremail'];
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];

  // Check if email exists
  $sql_check = "SELECT email FROM user_details WHERE email = ?";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bind_param("s", $email);
  $stmt_check->execute();
  $stmt_check->store_result();

  if (strlen($contact) == 10) {
    if ($stmt_check->num_rows > 0) {
      // Email exists, update the record

      $sql_update = "UPDATE user_details SET username = ?, firstname = ?, lastname = ?, Uaddress = ?, contact = ? WHERE email = ?";
      $stmt_update = $conn->prepare($sql_update);
      $stmt_update->bind_param("ssssss", $username, $firstname, $lastname, $address, $contact, $email);
      $stmt_update->execute();

      if ($stmt_update->affected_rows > 0) {
        showNotification("Success!", "Profile Successfully Updated");
      } else {
        showNotification("No Changes", "No changes were made to your profile.");
      }
      $stmt_update->close();
    } else {
      try {
        // Email does not exist, insert new record
        $sql_insert = "INSERT INTO user_details (username, firstname, lastname, Uaddress, contact, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssssss", $username, $firstname, $lastname, $address, $contact, $email);
        $stmt_insert->execute();
      } catch (Exception $e) {
        echo "<center><h1>Please enter data , Don't leave missing fields</h1></center>";
      }

      if ($stmt_insert->affected_rows > 0) {
        showNotification("Success!", "A new profile has been created successfully!");
      } else {
        showNotification("Failed!", "Failed to create a new profile. Please try again later.");
      }
      $stmt_insert->close();
    }

  } else {
    showNotification("Failed!", "Please enter a valid phone number.");
  }
  $stmt_check->close();
}

if (isset($_POST['securitysubmit'])) {
  $newPassword = $_POST['newPassword'];
  $confirmPassword = $_POST['confirmPassword'];

  // Ensure new password and confirm password match
  if ($newPassword === $confirmPassword && $newPassword !== "" && $confirmPassword !== "") {

    $hashpass = password_hash($newPassword, PASSWORD_BCRYPT);
    // Update the password directly in the database
    $sql = "UPDATE users SET user_password = ? WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashpass, $email);

    if ($stmt->execute()) {
      $_SESSION['profilesuccess'] = true;
      header("Location: profiledesign.php");
      exit();
    } else {
      $_SESSION['profileerror'] = true;
      header("Location: profiledesign.php");
      exit();
    }
    $stmt->close();
  } else {
    $_SESSION['profileerror'] = true;

    header("Location: profiledesign.php");
    exit();
  }
}


$sql = "SELECT username, firstname, lastname, Uaddress, contact FROM user_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->bind_result($username, $firstname, $lastname, $address, $contact);
  $stmt->fetch();
} else {
  $username = $firstname = $lastname = $address = $contact = "";
}
$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin-top: 20px;
      /* background-color:rgb(246, 246, 246); */
      background-color: rgb(38, 38, 38);
      color: #69707a;
    }

    .card {
      box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
      border-radius: 0.35rem;
      /* background-color: #fff; */
      background-image: url('assets/images/faq-bg.png');
      background-size: cover;
      background-position: center;
      margin-bottom: 1rem;
    }

    .card-header {
      font-weight: 500;
      background-color: rgba(33, 40, 50, 0.03);
      border-bottom: 1px solid rgba(33, 40, 50, 0.125);
      color: white;
    }

    .nav-borders .nav-link.active {
      color: #0061f2;
      border-bottom-color: #0061f2;
      padding-right: 17px;
    }

    .nav-borders .nav-link {
      color: #69707a;
      border-bottom-width: 0.125rem;
      border-bottom-style: solid;
      border-bottom-color: transparent;
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
      padding-left: 0;
      padding-right: 0;
      margin-left: 1rem;
      margin-right: 1rem;
    }

    .mb-1 {
      color: white;
    }



    /* Apply border radius and input styles with higher specificity */
    input.form-control {
      border-radius: 12px;
      /* Adjust the radius as needed */
      padding: 10px;
      /* Optional, for spacing inside the input */
      border: 1px solid black;
      /* Optional, for default border color */
      width: 100%;
      /* Makes the input take full width if needed */
      box-sizing: border-box;
      /* Ensures padding and border don't affect the width */
    }

    /* Focus state for input fields */
    input.form-control:focus {
      outline: none;
      /* Removes the default focus outline */
      border-color: rgb(170, 255, 173);
      /* Change border color on focus */
      background-color: hsl(201, 100.00%, 94.50%);
      /* Optional, change background color when focused */
    }

    /* Change the selection color of the text inside the input */
    input.form-control::selection {
      background-color: rgb(170, 255, 173);
      /* Change the background color of selected text */
      color: white;
      /* Change the color of the selected text */
    }
  </style>
</head>

<body>


  <div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
      <a class="nav-link active ms-0" href="#"><i class="fa-solid fa-user"></i> Profile</a>
      <a class="nav-link active ms-0" href="index.php"><i class="fa-solid fa-bell-concierge"></i> Home</a>
      <a class="nav-link active ms-0" href="OrdersHistory.php"> <i class="fa-solid fa-circle-xmark"></i> Orders</a>
      <a class="nav-link active ms-0" href="usernotify.php"> <i class="fa-solid fa-circle-xmark"></i> Notifications</a>
      <a class="nav-link active ms-0" href="logout.php"> <i class="fa-solid fa-circle-xmark"></i> Logout</a>

    </nav>
    <hr class="mt-0 mb-4">
    <div id="profile-details" class="card bg-dark repeat-img">
      <div class="card-header">Profile Details</div>
      <div class="card-body">
        <form action="profiledesign.php" method="POST">
          <!-- Username -->
          <div class="mb-3">
            <label class="small mb-1" for="inputUsername">Username</label>
            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" name="username"
              value="<?php echo $username; ?>">
          </div>
          <!-- First and Last Name -->
          <div class="row gx-3 mb-3">
            <div class="col-md-6">
              <label class="small mb-1" for="inputFirstName">First name</label>
              <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name"
                name="firstname" value="<?php echo $firstname; ?>">
            </div>
            <div class="col-md-6">
              <label class="small mb-1" for="inputLastName">Last name</label>
              <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name"
                name="lastname" value="<?php echo $lastname; ?>">
            </div>
          </div>
          <!-- Email -->
          <div class="mb-3">
            <label class="small mb-1" for="address">Address</label>
            <input class="form-control" id="Address" type="text" name="address" placeholder="Enter your address"
              value="<?php echo $address; ?>">
          </div>
          <!-- Phone and Birthday -->
          <div class="row gx-3 mb-3">
            <div class="col-md-6">
              <label class="small mb-1" for="inputPhone">Phone number</label>
              <input class="form-control" id="inputPhone" name="contact" type="number"
                placeholder="Enter your phone number" value="<?php echo $contact; ?>">
            </div>
            <div class="col-md-6">
              <label class="small mb-1" for="inputEmailAddress">Email address</label>
              <input class="form-control" id="inputEmail" type="text" name="email" placeholder="Example@gmail.com"
                value="<?php echo $email; ?>">
            </div>
          </div>
          <!-- Save changes button-->
          <button class="btn btn-primary" type="submit" name="submit">Save changes</button>
        </form>
      </div>
    </div>


    <br><br>
    <div id="security-settings" class="card bg-dark repeat-img">
      <div class="card-header">Security Settings</div>
      <div class="card-body">
        <form action="profiledesign.php" method="POST">
          <!-- Change Password -->
          <h5 class="mb-3" style="color:grey">Change Password</h5>
          <div class="mb-3">
            <label class="small mb-1" for="currentPassword">Current Password</label>
            <input class="form-control" id="currentPassword" name="currentPassword" type="password"
              placeholder="Enter current password">
          </div>
          <div class="mb-3">
            <label class="small mb-1" for="newPassword">New Password</label>
            <input class="form-control" id="newPassword" type="password" name="newPassword"
              placeholder="Enter new password">
          </div>
          <div class="mb-3">
            <label class="small mb-1" for="confirmPassword">Confirm Password</label>
            <input class="form-control" id="confirmPassword" type="password" name="confirmPassword"
              placeholder="Confirm new password">
          </div>
          <span class="subtitle" id="warn" style="color:red; display:none;"><i
              class="fa-solid fa-triangle-exclamation"></i> Please Enter New password and Current password
            correctly</span>
          <span class="subtitle" id="success" style="color:green; display:none;"><i
              class="fa-solid fa-triangle-exclamation"></i> New password successfully updated</span>

          <br><!-- Save changes button-->
          <button class="btn btn-primary" type="submit" name="securitysubmit">Save changes</button>
        </form </div>

        <?php
        if (isset($_SESSION['profileerror']) && $_SESSION['profileerror'] == true) {
          echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('warn').style.display = 'block';
            });
        </script>";
          // Clear the warning session variable so it doesn’t persist on refresh
          unset($_SESSION['profileerror']);
        }

        if (isset($_SESSION['profilesuccess']) && $_SESSION['profilesuccess'] == true) {
          echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('success').style.display = 'block';
            });
        </script>";
          // Clear the warning session variable so it doesn’t persist on refresh
          unset($_SESSION['profilesuccess']);
        }

        ?>

        <br>

        <!-- Footer Start -->
        <div class="footer-5-column">
          <div class="footer-container">
            <!-- Footer Navigation Start -->
            <div class="footer-navbar-container">
              <div class="footer-company-details">
                <!-- <div class="footer-details-inner"> -->
                <div class="footer-logo">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" color="white" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                  </svg>
                </div>
                <div class="footer-content">
                  <p>
                    Taste You Can Trust: From our kitchen to your plate, we promise uncompromised quality, genuine
                    service, and memorable flavors.
                  </p>
                </div>
                <div class="footer-icons">
                  <ul>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <path
                            d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"
                            fill="white" />
                        </svg>

                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <path fill="white"
                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />

                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="white"
                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="white"
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
                  <h5 style="color:white;">Solutions</h5>
                  <ul>
                    <li><a href="#"> FoodCounter </a></li>
                    <li><a href="#"> Feedback</a></li>
                    <li><a href="#"> Insight </a></li>
                    <li><a href="#"> Explore Menu </a></li>
                  </ul>
                </div>
                <div class="footer-navbar-col">
                  <h5 style="color:white;">Support</h5>
                  <ul>
                    <li><a href="#"> Home </a></li>
                    <li><a href="#"> About </a></li>
                    <li><a href="#"> Contact </a></li>
                    <li><a href="#"> Location </a></li>
                  </ul>
                </div>
                <div class="footer-navbar-col">
                  <h5 style="color:white;">Company</h5>
                  <ul>
                    <li><a href="#"> Terms and Conditions </a></li>
                    <li><a href="#"> Polices </a></li>
                    <li><a href="#"> Privacy </a></li>
                    <li><a href="#"> Insight </a></li>
                  </ul>
                </div>
                <div class="footer-navbar-col">
                  <h5 style="color:white;">Legal</h5>
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
</body>

</html>