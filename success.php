<?php
if (isset($_GET['payment_id'])) {
    echo "Payment successful! Payment ID: " . htmlspecialchars($_GET['payment_id']);
}
?>
