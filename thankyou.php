<?php
session_start();

$order_id = $_SESSION['order_id'] ?? 'N/A';
$payment_status = $_SESSION['payment_status'] ?? 'Unknown';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Your Order ID is: <strong>#<?= $order_id; ?></strong></p>
    <p>Payment Status: <strong><?= $payment_status; ?></strong></p>
    <a href="orders.php">View Orders</a>
</body>
</html>
