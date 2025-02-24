<?php
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>

<section id="sidebar">
    <ul class="side-menu top">
        <li class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
            <a href="dashboard.php"><i class='bx bxs-dashboard'></i> <span class="text">Dashboard</span></a>
        </li>
        <li class="<?= ($current_page == 'orders.php') ? 'active' : '' ?>">
            <a href="orders.php"><i class='bx bxs-shopping-bag-alt'></i> <span class="text">Orders</span></a>
        </li>
        <li class="<?= ($current_page == 'customers.php') ? 'active' : '' ?>">
            <a href="customers.php"><i class='bx bxs-user'></i> <span class="text">Customers</span></a>
        </li>
        <li class="<?= ($current_page == 'location.php') ? 'active' : '' ?>">
            <a href="setLocation.php"><i class='bx bxs-map'></i> <span class="text">Location</span></a>
        </li>
        <li class="<?= ($current_page == 'feedbacks.php') ? 'active' : '' ?>">
            <a href="feedbacks.php"><i class='bx bxs-comment'></i> <span class="text">Feedbacks</span></a>
        </li>
        <li class="<?= ($current_page == 'categories.php') ? 'active' : '' ?>">
            <a href="categories.php"><i class='bx bxs-category'></i> <span class="text">Categories</span></a>
        </li>
        <li class="<?= ($current_page == 'products.php') ? 'active' : '' ?>">
            <a href="products.php"><i class='bx bxs-category'></i> <span class="text">Products</span></a>
        </li>
        <li class="<?= ($current_page == 'inventory.php') ? 'active' : '' ?>">
            <a href="inventory.php"><i class='bx bxs-category'></i> <span class="text">Inventory</span></a>
        </li>
        <li class="<?= ($current_page == 'suppliers.php') ? 'active' : '' ?>">
            <a href="suppliers.php"><i class='bx bxs-category'></i> <span class="text">Suppliers</span></a>
        </li>
        <li class="<?= ($current_page == 'adminnotify.php') ? 'active' : '' ?>">
            <a href="adminnotify.php"><i class='bx bxs-category'></i> <span class="text">Notifications</span></a>
        </li>
        <li class="<?= ($current_page == 'reports.php') ? 'active' : '' ?>">
            <a href="reports.php"><i class='bx bxs-category'></i> <span class="text">Reports</span></a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="admin.php" class="logout"><i class='bx bxs-log-out-circle'></i> <span class="text">Logout</span></a>
        </li>
    </ul>
</section>





