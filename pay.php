<?php
session_start();
include("connection.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['number'];
$order_id = 'ORD' . rand(100000, 999999);
$_SESSION['order_id'] = $order_id;

// Fetch total cart amount
$total_price = 0;
$cart_query = mysqli_query($conn, "SELECT * FROM cart");
while ($row = mysqli_fetch_assoc($cart_query)) {
    $total_price += $row['price'] * $row['quantity'];
}

$ch = curl_init();

$data = array(
    'purpose' => 'Order #' . $order_id,
    'amount' => $total_price,
    'buyer_name' => $name,
    'email' => $email,
    'phone' => $phone,
    'redirect_url' => 'https://7c11-103-190-198-174.ngrok-free.app/project/payment_success.php',
    'send_email' => false,
    'send_sms' => false,
    'allow_repeated_payments' => false
);

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "X-Api-Key: 4001cac6c15a75beac6deed2129cdb2a",
    "X-Auth-Token: 1db8673dd5815f859083ead3202bd8b3"
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response, true);

if ($response && $response['success'] && isset($response['payment_request']['longurl'])) {
    header('Location: ' . $response['payment_request']['longurl']);
    exit;
} else {
    echo "⚠️ Error: Could not initiate payment.<br>";
    echo "<pre>";
    print_r($response);
    echo "</pre>";
}
?>
