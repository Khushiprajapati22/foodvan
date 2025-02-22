<?php
session_start();


if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header("Location: logout.php");
    header("Location: loginauth.php");
    exit();
}

if(isset($_SESSION['tick']) && $_SESSION['tick']==true)
{
    header("Location: profiledesign.php");
    exit();
}

// Database
$host = "localhost"; 
$username = "root";
$password = "abhi879687#";
$database = "spicymonk"; 

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
 // Fetch hashed password from the database
 $stmt = $conn->prepare("SELECT user_password FROM users WHERE user_email = ?");
 $stmt->bind_param("s", $email);
 $stmt->execute();
 $stmt->bind_result($hashedPassword);
 $stmt->fetch();
 $stmt->close();

 if ($hashedPassword) {
     // Compare the entered password with the hashed password
     if (password_verify($password, $hashedPassword)) {
        
        $_SESSION['email'] = $email;

        // Redirect 
     
        $_SESSION['user'] = true;
       $_SESSION['tick']=true;
       header("Location: profiledesign.php");
        $_SESSION['user'] = true;
        $_SESSION['useremail'] = $email;

     } else {
        $_SESSION['user'] = false;
    
        $_SESSION['warning'] = true;
    
        header('Location: loginauth.php');
        exit();
    }

    $stmt->close();
}else{
    
    $_SESSION['warning'] = true;
    header('Location: loginauth.php');
    exit();
        

}
}

$conn->close();


?>
