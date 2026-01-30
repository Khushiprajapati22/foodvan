<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

// Include database connection
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['location'];
    $stmt = $conn->prepare("REPLACE INTO location (id, location_name) VALUES (1, ?)");
    $stmt->bind_param("s", $location);
    $stmt->execute();
    $stmt->close();
}

$result = $conn->query("SELECT location_name FROM location WHERE id = 1");
$locationName = ($row = $result->fetch_assoc()) ? $row['location_name'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location</title>
    <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top:20px;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top:20px;
        }

        input {
            flex: 1;
            padding: 10px;
            border-radius: 15px;
            border: 1px solid #ccc;
            outline: none;
        }

        button {
            background: lightblue;
            border: none;
            padding: 10px 15px;
            border-radius: 15px;
            cursor: pointer;
        }

        iframe {
            width: 100%;
            height: 300px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
    </nav>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Location</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="location.php">Location</a></li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <h3 style="font-weight:normal;">Update Current Location</h3>
                <form method="POST">
                    <div class="input-group">
                        <input type="text" name="location" id="locationInput" value="<?php echo $locationName; ?>" placeholder="Enter location">
                        <button type="submit">Update</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h3 style="font-weight:normal;">Location Map</h3>
                <iframe id="mapFrame" src="https://www.google.com/maps?q=<?php echo urlencode($locationName); ?>&output=embed"></iframe>
            </div>
        </div>
    </main>
</section>

<script>
    document.getElementById("locationInput").addEventListener("input", function() {
        let location = this.value.trim();
        document.getElementById("mapFrame").src = "https://www.google.com/maps?q=" + encodeURIComponent(location) + "&output=embed";
    });
</script>

</body>
</html>

<?php $conn->close(); ?>
