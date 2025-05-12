<?php
session_start();
include("connection.php");
@include 'config.php';

// Redirect to login if not logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION['email'];
?>
<?php
 // Start the session

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['email']); // Assuming user email is stored in session

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>My Orders</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <!-- Custom CSS -->
   <link rel="stylesheet" href="cart.css">
   <style>
     body {
            padding-top: 63px;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: black;
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .container1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .logo {
            font-size: 24px;
            color: white;
            font-weight: bold;
        }
        .nav-list {
            list-style: none;
            display: flex;
        }
        .nav-list li {
            margin-left: 20px;
        }
        .nav-list a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 8px 12px;
            transition: 0.3s;
        }
        .nav-list a:hover {
            color: #ffcc00;
        }
      .orders-container {
         max-width: 1000px;
         margin: 50px auto;
         padding: 20px;
         background: #fff;
         border-radius: 10px;
         box-shadow: 0 0 15px rgba(0,0,0,0.1);
      }

      .orders-container h1 {
         text-align: center;
         margin-bottom: 30px;
         color: #333;
      }

      .order-card {
         border: 1px solid #ddd;
         border-radius: 10px;
         padding: 15px;
         margin-bottom: 20px;
         background-color: #f9f9f9;
      }

      .order-card h3 {
         margin: 0 0 10px;
         font-size: 20px;
         color: #333;
      }

      .order-card p {
         margin: 6px 0;
         font-size: 15px;
         color: #555;
      }

      .no-orders {
         text-align: center;
         color: #999;
         font-size: 18px;
         margin-top: 50px;
      }

      @media (max-width: 600px) {
         .order-card {
            font-size: 14px;
         }
      }
      .menu-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
  }
  
  .menu-toggle .bar {
    background-color: #fff;
    height: 3px;
    width: 25px;
    margin: 5px;
  }
@media (max-width:768px){
    .nav-list {
        display: none;
        flex-direction: column;
        width: 100%;
        position: absolute;
        top: 60px;
        left: 0;
        background-color: #333;
        /*  background for mobile view */
    }
  
    .nav-list.active {
        display: flex;
    }
  
    .nav-list li {
        margin: 10px 0;
        text-align: center;
    }
  
    .menu-toggle {
        display: flex;
    }
    .container1 h1{
        font-size: 15px;
    }
}
   </style>
</head>
<body>
<header>
    <div class="container1">
        <h1 class="logo">Multi-Cuisine Restaurant</h1>
        <?php if ($isLoggedIn): ?>
            <p style="color: white;">Hi, <?= htmlspecialchars($_SESSION['email']); ?></p>
        <?php endif; ?>
        <nav>
            <ul class="nav-list">
                <li><a href="#">Home</a></li>
                <li><a href="menu3.php">Menu</a></li>
                <li><a href="review1.php">Review</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <div class="menu-toggle">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
        </nav>
    </div>
</header>
<script>
            document.addEventListener('DOMContentLoaded', () => {
                const menuToggle = document.querySelector('.menu-toggle');
                const navList = document.querySelector('.nav-list');
        
                menuToggle.addEventListener('click', () => {
                    navList.classList.toggle('active');
                });
            });
        </script>
<div class="orders-container">
   <h1>Your Orders</h1>
   <a href="menu3.php" class="btn">Back</a>
   <?php
   $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE email = '$email' ORDER BY id DESC");

   if (mysqli_num_rows($order_query) > 0) {
      while ($row = mysqli_fetch_assoc($order_query)) {
         echo '<div class="order-card">';
         echo '<h3>Order ID: ' . $row['order_id'] . '</h3>';
         echo '<p><strong>Items:</strong> ' . $row['total_products'] . '</p>';
         echo '<p><strong>Total:</strong> ₹' . $row['total_price'] . '</p>';
         echo '<p><strong>Payment Method:</strong> ' . ucfirst($row['payment_method']) . '</p>';
         echo '<p><strong>Table No:</strong> ' . $row['table_no'] . '</p>';
         echo '<p><strong>Instructions:</strong> ' . $row['instructions'] . '</p>';
         echo '<p><strong>Status:</strong> <span style="color:' . ($row['status'] == 'Paid' ? 'green' : 'orange') . '">' . $row['status'] . '</span></p>';
         echo '<p><strong>Placed on:</strong> ' . $row['created_at'] . '</p>';
         echo '</div>';
      }
   } else {
      echo '<div class="no-orders">You have not placed any orders yet.</div>';
   }
   ?>
 <h2>Please give us your feedback.</h2>
 <a href="review1.php"><button type="button" class="btn">Review</button></a>
</div>

</body>
</html>
