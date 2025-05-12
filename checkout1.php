<?php
include("connection.php");
@include 'config.php';

function generateOrderID() {
    return 'ORD' . mt_rand(100000, 999999);
}

if (isset($_POST['order_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $paymethod = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $tableno = mysqli_real_escape_string($conn, $_POST['table_no']);
    $instructions = mysqli_real_escape_string($conn, $_POST['instructions']);

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
    $price_total = 0;
    $product_name = [];

    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ')';
            $product_price = $product_item['price'] * $product_item['quantity'];
            $price_total += $product_price;
        }
    }

    $total_product = implode(', ', $product_name);
    $order_id = generateOrderID();
    $status = 'Pending';

    // Insert order into database
    $detail_query = mysqli_query($conn, "INSERT INTO `orders`(order_id, name, number, email, payment_method, table_no, instructions, total_products, total_price, status) 
        VALUES('$order_id','$name','$number','$email','$paymethod','$tableno','$instructions','$total_product','$price_total', '$status')") or die('Insert query failed');

    if ($cart_query && $detail_query) {
        if ($paymethod == 'cash on delivery') {
            echo "<script>alert('Order $order_id placed successfully with Cash on Delivery!'); window.location.href='orders.php?order_id=$order_id';</script>";
            exit;
        } else if ($paymethod == 'upi') {
         session_start();
         $_SESSION['order_id'] = $order_id;
         $_SESSION['order_amount'] = $price_total;
         $_SESSION['name'] = $name;
         $_SESSION['email'] = $email;
         $_SESSION['number'] = $number;
      
         header("Location: pay.php");
         exit;
      }
      
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="cart.css">
<style>
   .payment-method-box {
   display: flex;
   flex-direction: column;
   gap: 15px;
   border: 1px solid #ccc;
   padding: 15px;
   border-radius: 10px;
   margin-top: 15px;
   background: #fff;
}

.payment-method-box label {
   display: flex;
   align-items: center;
   gap: 10px;
   font-size: 16px;
   cursor: pointer;
}

.payment-method-box input[type="radio"] {
   transform: scale(1.2);
   margin-right: 8px;
}

.payment-method-box img {
   margin-left: 5px;
}
.payment-extra {
   margin-left: 30px;
   margin-top: 10px;
   display: flex;
   flex-direction: column;
   gap: 10px;
}

.payment-extra input, .payment-extra select {
   padding: 8px;
   border: 1px solid #ccc;
   border-radius: 6px;
}

.hidden {
   display: none;
}

</style>
</head>
<body>



<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM cart");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="tel"   pattern="[0-9]{10}" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="payment-method-box">
   <span>Select Payment Method</span>

   <!-- UPI -->
   <label>
      <input type="radio" name="payment_method" value="upi" onclick="showPaymentFields('upi')">
      <strong>UPI</strong>
   </label>
   
   <!-- Cash on Delivery -->
   <label>
      <input type="radio" name="payment_method" value="cash on delivery" checked onclick="showPaymentFields('cod')">
      <strong>Cash on Delivery</strong>
      <small>Pay with cash/UPI/card on delivery.</small>
   </label>
</div>

         <div class="inputBox">
            <span>table no</span>
            <input type="text" placeholder="enter your table no" name="table_no" required>
         </div>
         <div class="inputBox">
            <span> special instructions</span>
            <input type="text" placeholder="e.g. spicy,extra sauce..." name="instructions" required>
         </div>
        
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
      
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="script.js"></script>
<script>
function showPaymentFields(method) {
   // Hide all
   document.querySelectorAll('.payment-extra').forEach(div => div.classList.add('hidden'));

   // Show selected one
   const box = document.getElementById(`${method}-box`);
   if (box) box.classList.remove('hidden');
}
</script>

</body>
</html>