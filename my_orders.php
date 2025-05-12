<?php
session_start();
include 'connection.php'; // Database connection file

if (!isset($_SESSION['email'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_email = $_SESSION['email']; // Assuming you store the email in session
$sql = "SELECT id, table_no, payment_method, total_products, total_price, created_at FROM orders WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);
?>
