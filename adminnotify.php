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

// Handle status update request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["order_id"])) {
        $order_id_str = $_POST["order_id"]; // This is the 'order_id' from orders (VARCHAR)

        // 🔹 Get the corresponding 'id' from orders table
        $stmt = $conn->prepare("SELECT id FROM orders WHERE order_id = ?");
        $stmt->bind_param("s", $order_id_str); 
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$result) {
            echo "error"; // Order not found
            exit();
        }

        $order_status_id = $result['id']; // INT from orders.id

        // 🔹 Update order_status table
        $stmt = $conn->prepare("UPDATE order_status SET status = 'done' WHERE order_id = ?");
        $stmt->bind_param("i", $order_status_id);
        $success = $stmt->execute();
        $stmt->close();

        echo $success ? "success" : "error";
        exit();
    }

    if (isset($_POST["inventory_id"], $_POST["new_stock"])) {
        $inventory_id = $_POST["inventory_id"];
        $new_stock = $_POST["new_stock"];

        $stmt = $conn->prepare("UPDATE inventory SET stock = ? WHERE id = ?");
        $stmt->bind_param("ii", $new_stock, $inventory_id);
        $success = $stmt->execute();
        $stmt->close();

        echo $success ? "success" : "error";
        exit();
    }
}

// Step 1: Fetch pending order's ID from order_status
$sql = "SELECT order_id FROM order_status WHERE status = 'pending' ORDER BY order_id DESC";
$result = $conn->query($sql);

$orders = []; // Array to store unique order IDs

while ($row = $result->fetch_assoc()) {
    $orderStatusId = $row['order_id']; 

    // Step 2: Fetch the actual order_id from orders where orders.id = order_status.order_id
    $stmt = $conn->prepare("SELECT order_id FROM orders WHERE id = ?");
    $stmt->bind_param("i", $orderStatusId);
    $stmt->execute();
    $orderResult = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($orderResult) {
        $orders[] = $orderResult['order_id']; 
    }
}

// Fetch out-of-stock items
$inventory_sql = "SELECT id, title FROM inventory WHERE stock = 0";
$inventory_result = $conn->query($inventory_sql);
$inventory_items = $inventory_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Notifications</title>
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .update-btn {
            background-color: #90EE90; /* Light Green */
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .update-btn:hover {
            background-color: #4CAF50; /* Darker Green */
            color: white;
        }

        .stock-input {
            width: 60px;
            text-align: center;
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
                <h1>Admin Notifications</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="adminnotification.php">Notifications</a></li>
                </ul>
            </div>
        </div>

        <!-- Pending Orders Section -->
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Pending Orders</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="notificationTable">
                        <?php foreach ($orders as $order_id) { ?>
                            <tr>
                                <td>Order #<?php echo $order_id; ?></td>
                                <td>
                                    <button class="update-btn" data-id="<?php echo $order_id; ?>">Mark as Done</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if (empty($orders)): ?>
                    <p class="text-center text-muted">No pending orders.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Out-of-Stock Items Section -->
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Out of Stock Items</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTable">
                        <?php foreach ($inventory_items as $item) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['title']); ?></td>
                                <td>
                                    <button class="update-btn stock-update-btn" data-id="<?php echo $item['id']; ?>">Update</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if (empty($inventory_items)): ?>
                    <p class="text-center text-muted">No out-of-stock items.</p>
                <?php endif; ?>
            </div>
        </div>

    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script>
    $(document).on("click", ".update-btn", function() {
        var orderId = $(this).data("id");
        var button = $(this);

        $.ajax({
            url: "adminnotify.php",
            type: "POST",
            data: { order_id: orderId },
            success: function(response) {
                if (response.trim() === "success") {
                    button.closest("tr").fadeOut();
                }
            }
        });
    });

    $(document).on("click", ".stock-update-btn", function() {
        var button = $(this);
        var inventoryId = button.data("id");

        button.replaceWith('<input type="number" class="stock-input" min="1" id="stock_' + inventoryId + '"> <button class="ok-btn" data-id="' + inventoryId + '">OK</button>');
    });

    $(document).on("click", ".ok-btn", function() {
        var inventoryId = $(this).data("id");
        var newStock = $("#stock_" + inventoryId).val();
        var button = $(this);

        $.ajax({
            url: "adminnotify.php",
            type: "POST",
            data: { inventory_id: inventoryId, new_stock: newStock },
            success: function(response) {
                if (response.trim() === "success") {
                    button.closest("td").html('<button class="update-btn stock-update-btn" data-id="' + inventoryId + '">Update</button>');
                }
            }
        });
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
