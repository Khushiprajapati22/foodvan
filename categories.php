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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO category (title, description) VALUES ('$title', '$description')";
    if ($conn->query($sql) === TRUE) {
        showNotification("Success ", "Category inserted successfully");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['delete_category'])) {
    $title = $_POST['title'];
    if (empty($title)) {
        showNotification("Hello there!", "PLease enter title and description");

    } else {
        $sql = "DELETE FROM category WHERE title = '$title'";
        if ($conn->query($sql) === TRUE) {
            
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$sql = "SELECT id, title, description FROM category";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .form-container {
            margin-bottom: 20px;
        }

        .form-container input, .form-container textarea {
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
        }

        .form-container button:hover {
            background-color:rgb(73, 97, 135);
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
                <h1>Categories</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="categories.php">Categories</a></li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <h3 style="font-weight:normal; margin-top:10px; margin-bottom:10px;">Add Category</h3>
            <form method="POST">
                <input type="text" name="title" placeholder="Category Title" required>
                <textarea name="description" placeholder="Category Description" rows="4" ></textarea>
                <button type="submit">Add</button>
                <button type="submit" name="delete_category" class="delete-btn">Delete Category</button>
            </form>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Category Details</h3>
                    <i class='bx bx-search' id="searchIcon"></i>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search Category...">
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTable">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
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
        let rows = document.querySelectorAll("#categoryTable tr");

        rows.forEach(row => {
            let categoryTitle = row.querySelector("td:nth-child(2)").textContent;
            row.style.display = categoryTitle.toUpperCase().includes(filter) ? "" : "none";
        });
    });


</script>

<script src="dashscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
