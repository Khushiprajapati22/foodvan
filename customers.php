<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

// Include database connection
require_once 'db.php';

$sql = "SELECT username, firstname, lastname, Uaddress, contact, email FROM user_details ORDER BY username ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
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
            top: -3px; /* Move the icon slightly up */
            cursor: pointer;
        }

        .search-container input {
            width: 200px; /* Adjust width as needed */
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
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Customers</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="customers.php">Customers</a></li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Customer Details</h3>
                    <i class='bx bx-search' id="searchIcon"></i>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search by Email...">
                    </div>
                </div>
              
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody id="customerTable">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['Uaddress']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td class="customer-email"><?php echo $row['email']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll("#customerTable tr");

        rows.forEach(row => {
            let email = row.querySelector(".customer-email").textContent;
            row.style.display = email.toUpperCase().includes(filter) ? "" : "none";
        });
    });
</script>

<script src="dashscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
