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
    $rating = $_POST['rating'];
    $type = $_POST['type'];
    $persons = $_POST['persons'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes
        $fileSize = $_FILES['image']['size'];

        // Check for UPLOAD_ERR_INI_SIZE (exceeds upload_max_filesize in php.ini)
        if ($_FILES['image']['error'] === UPLOAD_ERR_INI_SIZE) {
            showNotification("Failed", "Upload image size must not exceed 2MB");
            exit();
        } else {
            // File upload process
            $targetDir = "assets/images/dish/"; // Relative path

            // Create folder if not exists
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileName = basename($_FILES['image']['name']);
            $targetFile = $targetDir . $fileName;

            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                showNotification("Failed", "Error: " . $_FILES['image']['error']);
                header("Location: products.php"); 
                exit();
            } else {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = $targetDir . $fileName;
                    showNotification("Success", "Product added successfully");
                } else {
                    showNotification("Failed", "Error: Failed to move uploaded file. Check permissions.");
                    header("Location: products.php"); 
                    exit();
                }
            }
        }
    }

    // Check if it's a delete or update request
    if (isset($_POST['delete_product'])) {
        $deleteTitle = $_POST['title'];
        $deleteSql = "DELETE FROM products WHERE title = '$deleteTitle'";
        if ($conn->query($deleteSql) === TRUE) {
            showNotification("Success", "Product deleted successfully");
        } else {
            showNotification("Failed", "Error: " . $conn->error);
        }
    } elseif (isset($_POST['update_product'])) {
        $updateSql = "UPDATE products SET description='$description', rating='$rating', type='$type', persons='$persons', price='$price', category='$category', image_path='$imagePath' WHERE title='$title'";
        if ($conn->query($updateSql) === TRUE) {
            showNotification("Success", "Product updated successfully");
        } else {
            showNotification("Failed", "Error: " . $conn->error);
        }
    } else {
        $sql = "INSERT INTO products (title, description, rating, type, persons, price, category, image_path) 
                VALUES ('$title', '$description', '$rating', '$type', '$persons', '$price', '$category', '$imagePath')";
        if ($conn->query($sql) === TRUE) {
            showNotification("Success", "Product added successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$sql = "SELECT id, image_path, rating, title, description, type, persons, price, category FROM products";
$result = $conn->query($sql);

// Fetch all categories
$categorySql = "SELECT * FROM category";
$categoryResult = $conn->query($categorySql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="icon" href="assets/icons/SpicyMonk-Logo-V2.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .form-container {
            margin-bottom: 20px;
        }

        .form-container input, .form-container textarea, .form-container select {
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
            background-color: #4CAF50;
            color: white;
        }

        .delete-btn, .update-btn {
            background-color: #f44336;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
        }

        .delete-btn:hover, .update-btn:hover {
            background-color: #e53935;
            color: white;
        }

        .form-buttons {
            display: flex;
            gap: 10px;
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
                <h1>Products</h1>
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="products.php">Products</a></li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <h3 style="font-weight:normal; margin-top:10px; margin-bottom:10px;">Manage Product</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Product Title" required>
                <textarea name="description" placeholder="Product Description" rows="4" required></textarea>
                <input type="number" name="rating" placeholder="Rating" step="0.1" min="0" max="5" required>
                <select name="type" required>
                    <option value="">Select Type</option>
                    <option value="Veg">Veg</option>
                    <option value="Non Veg">Non Veg</option>
                </select>
                <input type="number" name="persons" placeholder="Persons" required>
                <input type="number" name="price" placeholder="Price" required>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <?php while ($categoryRow = $categoryResult->fetch_assoc()) { ?>
                        <option value="<?php echo $categoryRow['title']; ?>"><?php echo $categoryRow['title']; ?></option>
                    <?php } ?>
                </select>
                <input type="file" name="image" accept="image/*">
                <div class="form-buttons">
                    <button type="submit">Add</button>
                    <button type="submit" name="delete_product" class="delete-btn">Delete</button>
                    <button type="submit" name="update_product" class="update-btn">Update</button>
                </div>
            </form>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Product Details</h3>
                    <i class='bx bx-search' id="searchIcon"></i>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search Product...">
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Rating</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Persons</th>
                            <th>Price</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><img src="<?php echo $row['image_path']; ?>" alt="Product Image" width="100"></td>
                                <td><?php echo $row['rating']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['type']; ?></td>
                                <td><?php echo $row['persons']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['category']; ?></td>
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
        let rows = document.querySelectorAll("#productTable tr");

        rows.forEach(row => {
            let productTitle = row.querySelector("td:nth-child(4)").textContent;
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
