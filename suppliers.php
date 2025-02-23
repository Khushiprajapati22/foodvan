<?php
session_start();
include 'notification.php';

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

// Handle form submission for adding supplier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_supplier'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        // Insert supplier
        $insertSql = "INSERT INTO suppliers (name, email, contact) VALUES ('$name', '$email', '$contact')";
        if ($conn->query($insertSql) === TRUE) {
            showNotification("Success", "Supplier added successfully.");
        } else {
            showNotification("Failed", "Error: " . $conn->error);
        }
    }

    if (isset($_POST['delete_supplier'])) {
        $supplierId = $_POST['supplier_id'];

        // Delete supplier record
        $deleteSql = "DELETE FROM suppliers WHERE id = '$supplierId'";
        if ($conn->query($deleteSql) === TRUE) {
            showNotification("Success", "Supplier deleted successfully.");
        } else {
            showNotification("Failed", "Error: " . $conn->error);
        }
    }
}

// Fetch supplier data
$supplierSql = "SELECT id, name, email, contact FROM suppliers";
$supplierResult = $conn->query($supplierSql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .form-container {
            margin-bottom: 20px;
        }

        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            outline: none;
        }

        .form-container button {
            background-color: lightblue;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            margin-right: 10px;
        }

        .form-container button:hover {
            background-color: #4CAF50;
            color: white;
        }

        .delete-btn {
            background-color: #f44336;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #e53935;
            color: white;
        }

        .search-container input {
            width: 200px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 15px;
            outline: none;
        }

        .form-container button:active {
            background-color: #45a049;
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
                <h1>Suppliers</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="suppliers.php">Suppliers</a></li>
                </ul>
            </div>
        </div>

        <!-- Add Supplier Section -->
        <div class="form-container">
            <h3 style="font-weight:normal; margin-top:10px; margin-bottom:10px;">Add Supplier</h3>
            <form method="POST">
                <input type="text" name="name" placeholder="Supplier Name" required>
                <input type="email" name="email" placeholder="Supplier Email" required>
                <input type="text" name="contact" placeholder="Supplier Contact" required>
                
                <!-- Add Supplier Button -->
                <button type="submit" name="add_supplier">Add Supplier</button>
            </form>
        </div>

        <!-- Supplier Data Table -->
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Supplier Details</h3>
                    <i class='bx bx-search' id="searchIcon"></i>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search Supplier...">
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Supplier ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="supplierTable">
                        <?php while ($row = $supplierResult->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="supplier_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_supplier" class="delete-btn">Delete</button>
                                    </form>
                                </td>
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
        let rows = document.querySelectorAll("#supplierTable tr");

        rows.forEach(row => {
            let supplierName = row.querySelector("td:nth-child(2)").textContent;
            row.style.display = supplierName.toUpperCase().includes(filter) ? "" : "none";
        });
    });
</script>

<script src="dashscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
