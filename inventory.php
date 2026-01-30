<?php
session_start();
include 'notification.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit();
}

// Include database connection
require_once 'db.php';

// Fetch all products for the select dropdown
$productSql = "SELECT title FROM products";
$productResult = $conn->query($productSql);

// Handle form submission for adding/updating inventory
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_inventory'])) {
        $productTitle = $_POST['product_title'];
        $stock = $_POST['stock'];

        // Insert inventory
        $insertSql = "INSERT INTO inventory (title, stock) VALUES ('$productTitle', '$stock')";
        if ($conn->query($insertSql) === TRUE) {
            showNotification("Success", "Inventory added successfully.");
        } else {
            showNotification("Failed", "Error: " . $conn->error);
        }
    }

    if (isset($_POST['delete_inventory'])) {
        $inventoryId = $_POST['inventory_id'];

        // Delete inventory record
        $deleteSql = "DELETE FROM inventory WHERE id = '$inventoryId'";
        if ($conn->query($deleteSql) === TRUE) {
            showNotification("Success", "Inventory deleted successfully.");
        } else {
            showNotification("Failed", "Error: " . $conn->error);
        }
    }

    if (isset($_POST['update_inventory'])) {
        $productTitle = $_POST['product_title'];
        $newStock = $_POST['stock'];

        // Update inventory stock
        $updateSql = "UPDATE inventory SET stock = '$newStock' WHERE title = '$productTitle'";
        if ($conn->query($updateSql) === TRUE) {
            showNotification("Success", "Inventory updated successfully.");
        } else {
            showNotification("Failed", "Error: " . $conn->error);
        }
    }
}

// Fetch inventory data joined with product titles
$inventorySql = "SELECT i.id, p.title, i.stock FROM inventory i JOIN products p ON i.title = p.title";
$inventoryResult = $conn->query($inventorySql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
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
                <h1>Inventory</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="inventory.php">Inventory</a></li>
                </ul>
            </div>
        </div>

        <!-- Add/Update Inventory Section -->
        <div class="form-container">
            <h3 style="font-weight:normal; margin-top:10px; margin-bottom:10px;">Manage Inventory</h3>
            <form method="POST">
                <select name="product_title" required>
                    <option value="">Select Product</option>
                    <?php while ($productRow = $productResult->fetch_assoc()) { ?>
                        <option value="<?php echo $productRow['title']; ?>"><?php echo $productRow['title']; ?></option>
                    <?php } ?>
                </select>
                <input type="number" name="stock" placeholder="Stock" required>
                
                <!-- Buttons for Add and Update -->
                <button type="submit" name="add_inventory">Add Inventory</button>
                <button type="submit" name="update_inventory">Update Inventory</button>
            </form>
        </div>

        <!-- Inventory Data Table -->
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Inventory Details</h3>
                    <i class='bx bx-search' id="searchIcon"></i>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search Inventory...">
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Inventory ID</th>
                            <th>Product Title</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTable">
                        <?php while ($row = $inventoryResult->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['stock']; ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="inventory_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_inventory" class="delete-btn">Delete</button>
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
        let rows = document.querySelectorAll("#inventoryTable tr");

        rows.forEach(row => {
            let productTitle = row.querySelector("td:nth-child(2)").textContent;
            row.style.display = productTitle.toUpperCase().includes(filter) ? "" : "none";
        });
    });
</script>

<script src="dashscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
