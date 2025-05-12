<?php
session_start();
include("connection.php");

// Check if Instamojo redirected with parameters
if (isset($_GET['payment_id']) && isset($_GET['payment_status']) && isset($_SESSION['order_id'])) {
    $payment_id = $_GET['payment_id'];
    $payment_status = $_GET['payment_status'];
    $order_id = $_SESSION['order_id'];

    if ($payment_status === 'Credit') {
        // Update the order status in DB
        $update = mysqli_query($conn, "UPDATE orders SET status='Paid', payment_id='$payment_id' WHERE order_id='$order_id'");

        echo "<h2>✅ Payment Successful!</h2>";
        echo "<p>Your order ID <strong>$order_id</strong> has been placed.</p>";
        echo "<p>Payment ID: $payment_id</p>";
        echo "<a href='orders.php?order_id=$order_id'>View Your Order</a>";

        // Optionally: clear cart
        mysqli_query($conn, "DELETE FROM cart");

        // Unset session
        unset($_SESSION['order_id']);
    } else {
        echo "<h2>❌ Payment Failed or Cancelled.</h2>";
        echo "<a href='checkout1.php'>Try Again</a>";
    }
} else {
    echo "<h3>⚠️ Invalid Payment Response</h3>";
}
?>
