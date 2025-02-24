<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

$host = "localhost";  
$username = "root";  
$password = "abhi879687#";  
$database = "spicymonk";  

$conn = new mysqli($host, $username, $password, $database);  

if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}

$sql = "SELECT id, name, email, phone, message FROM feedbacks ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .search-container {
            margin-bottom: 10px;
        }

        .search-container input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 15px;
            outline: none;
        }

        .head {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .head i {
            font-size: 20px;
            position: relative;
            top: -3px;
            cursor: pointer;
        }

        .search-container input {
            width: 200px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 15px;
            outline: none;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<?php include 'sidebar.php'; ?>
<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
    </nav>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Feedbacks</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="feedbacks.php">Feedbacks</a></li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Customer Feedbacks</h3>
                    <i class='bx bx-search' id="searchIcon"></i>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search Feedback...">
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody id="feedbackTable">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</section>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll("#feedbackTable tr");

        rows.forEach(row => {
            let name = row.querySelector("td:nth-child(1)").textContent;
            let email = row.querySelector("td:nth-child(2)").textContent;
            let phone = row.querySelector("td:nth-child(3)").textContent;
            let message = row.querySelector("td:nth-child(4)").textContent;
            
            if (name.toUpperCase().includes(filter) || email.toUpperCase().includes(filter) || phone.toUpperCase().includes(filter) || message.toUpperCase().includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>

<script src="dashscript.js"></script>

</body>
</html>

<?php $conn->close(); ?>
