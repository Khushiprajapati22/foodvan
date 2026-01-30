<?php
session_start();

// Include database connection
require_once 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["admin_email"];
    $currentPass = $_POST["current_password"];
    $newPass = $_POST["new_password"];
    $confirmPass = $_POST["confirm_password"];

    $stmt = $conn->prepare("SELECT admin_password FROM admins WHERE admin_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();

    if ($storedPassword && $currentPass === $storedPassword) {
        if ($newPass === $confirmPass) {
            $updateStmt = $conn->prepare("UPDATE admins SET admin_password = ? WHERE admin_email = ?");
            $updateStmt->bind_param("ss", $newPass, $email);
            if ($updateStmt->execute()) {
                echo "<script>alert('Password updated successfully!'); window.location.href='dashboard.php';</script>";
            } else {
                $message = "<div class='alert alert-danger'>Error updating password.</div>";
            }
            $updateStmt->close();
        } else {
            $message = "<div class='alert alert-danger'>New passwords do not match!</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Current password is incorrect!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Admin Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .password-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }
        .password-container h3 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
            height: 45px;
        }
        .btn-update {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s ease;
        }
        .btn-update:hover {
            background: #218838;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @media (max-width: 480px) {
            .password-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="password-container">
    <h3>Change Admin Password</h3>
    <?= $message ?>
    <form method="POST">
        <input type="email" name="admin_email" class="form-control" placeholder="Admin Email" required>
        <input type="password" name="current_password" class="form-control" placeholder="Current Password" required>
        <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
        <button type="submit" class="btn-update">Update Password</button>
    </form>
</div>

</body>
</html>
