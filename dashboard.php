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

// Fetch total counts
$orderCountQuery = "SELECT COUNT(*) AS total_orders FROM orders";
$orderResult = $conn->query($orderCountQuery);
$totalOrders = $orderResult->fetch_assoc()['total_orders'];

$customerCountQuery = "SELECT COUNT(*) AS total_customers FROM users";
$customerResult = $conn->query($customerCountQuery);
$totalCustomers = $customerResult->fetch_assoc()['total_customers'];

$salesQuery = "SELECT SUM(amount) AS total_sales FROM orders";
$salesResult = $conn->query($salesQuery);
$totalSales = $salesResult->fetch_assoc()['total_sales'];

// Fetch recent orders (latest 5)
$recentOrdersQuery = "SELECT order_id, username, amount, order_date FROM orders ORDER BY order_date DESC LIMIT 5";
$recentOrdersResult = $conn->query($recentOrdersQuery);

// Fetch to-do list
$todosQuery = "SELECT * FROM todos";
$todosResult = $conn->query($todosQuery);

// Handle new task addition
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['task'])) {
    $task = $conn->real_escape_string($_POST['task']);
    $conn->query("INSERT INTO todos (task) VALUES ('$task')");
    header("Location: dashboard.php");
    exit();
}

// Handle task deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $deleteId = intval($_POST['delete_id']);
    $conn->query("DELETE FROM todos WHERE id = $deleteId");
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">

	<style>
		.todo-container {
    width: 100%; 
    max-width: 400px; /* Increased width */
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.todo-container h3 {
    margin-bottom: 15px;
    color: #333;
}

.todo-container form {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.todo-container input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 12px;
    font-size: 16px;
}

.todo-container button {
    background:rgb(118, 212, 102);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 14px;
    cursor: pointer;
    font-size: 16px;
}

.todo-container button:hover {
    background: #218838;
}

.todo-container ul {
    list-style: none;
    padding: 0;
}

.todo-container li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 8px;
}

.todo-container li form button {
    background:rgb(216, 98, 110);
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 12px;
    cursor: pointer;
    font-size: 14px;
}

.todo-container li form button:hover {
    background: #c82333;
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
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                </ul>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <ul class="box-info">
            <li>
                <i class='bx bxs-shopping-bag'></i>
                <span class="text">
                    <h3><?php echo $totalOrders; ?></h3>
                    <p>Total Orders</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-user'></i>
                <span class="text">
                    <h3><?php echo $totalCustomers; ?></h3>
                    <p>Total Customers</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>Rs <?php echo number_format($totalSales, 2); ?></h3>
                    <p>Total Sales</p>
                </span>
            </li>
        </ul>

        <div class="table-data">
            <!-- Recent Orders -->
            <div class="order">
                <div class="head">
                    <h3>Recent Orders</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Username</th>
                            <th>Amount (Rs)</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $recentOrdersResult->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['order_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
 <!-- To-Do List -->
<div class="todo-container">
    <h3>To-Do List</h3>
    <form method="POST">
        <input type="text" name="task" placeholder="Add new task..." required>
        <button type="submit"><i class='bx bx-plus'></i></button>
    </form>
    <ul>
        <?php while ($todo = $todosResult->fetch_assoc()) { ?>
            <li>
                <?php echo htmlspecialchars($todo['task']); ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $todo['id']; ?>">
                    <button type="submit"><i class='bx bx-trash'></i></button>
                </form>
            </li>
        <?php } ?>
    </ul>
</div>


    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="dashscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
