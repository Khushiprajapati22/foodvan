<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

?>


<?php
// Include database connection
require_once 'db.php';

$sql = "SELECT order_id, email, username, title, quantity, amount, contact, order_date FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
                <h1>Orders</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="orders.php">Orders</a></li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Order Details</h3>
                    <i class='bx bx-search' id="searchIcon"></i>
                    <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search Order ID...">
                </div>
                </div>
              
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Amount (Rs)</th>
                            <th>Contact</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody id="orderTable">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td class="order-id"><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td><?php echo $row['order_date']; ?></td>
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
        let rows = document.querySelectorAll("#orderTable tr");

        rows.forEach(row => {
            let orderID = row.querySelector(".order-id").textContent;
            row.style.display = orderID.toUpperCase().includes(filter) ? "" : "none";
        });
    });
</script>

<script src="dashscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
