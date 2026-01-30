<?php
session_start();

// Include database connection
require_once 'db.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$searchValue = isset($_SESSION['serch-value-fetch']) ? $_SESSION['serch-value-fetch'] : '';
$categorySelected = isset($_SESSION['categoryselected']) ? $_SESSION['categoryselected'] : '';
$conditions = [];
$params = [];
$types = "";

// Initialize the base SQL query
$sql = "SELECT * FROM products";

// Add type filter
if ($type !== 'all') {
    $conditions[] = "type = ?";
    $types .= "s";
    $params[] = $type === 'veg' ? "Veg" : "Non Veg";
}

// Add search filter
if (!empty($searchValue)) {
    $conditions[] = "title LIKE ?";
    $types .= "s";
    $params[] = "%$searchValue%";
}

// Add category filter, but exclude if "All Menus" is selected
if (!empty($categorySelected) && $categorySelected !== "All Menus") {
    $conditions[] = "category = ?";
    $types .= "s";
    $params[] = $categorySelected;
}

// Combine conditions in SQL
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}


$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-4 col-sm-6 dish-box-wp">
                <div class="dish-box text-center">
                    <div class="dist-img"><img src="' . $row["image_path"] . '" alt="" height="85%" width="85%"></div>
                    <div class="dish-rating">' . $row["rating"] . '<i class="uil uil-star"></i></div>
                    <div class="dish-title"><h3 class="h3-title">' . $row["title"] . '</h3><p>' . $row["description"] . '</p></div>
                    <div class="dish-info"><ul>
                        <li><p>Type</p><b>' . ucfirst($row["type"]) . '</b></li>
                        <li><p>Persons</p><b>' . $row["persons"] . '</b></li>
                    </ul></div>
                    <div class="dist-bottom-row"><ul>
                        <li><b>Rs. ' . $row["price"] . '</b></li>
                        <li><button class="dish-add-btn" onclick="addToCart(this)"><i class="uil uil-plus"></i></button></li>
                    </ul></div>
                </div>
            </div>';
    }
} else {
    echo "<p style='position:absolute; left:640px;'><i class='fa-solid fa-seedling'></i> No products available</p>";
}

$stmt->close();
$conn->close();
?>
<!-- all menus new -->