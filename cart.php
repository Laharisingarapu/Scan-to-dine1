<?php
include("connection.php"); // Include the database connection

@include 'config.php';
session_start();
if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM cart");
   header('location:cart.php');
}
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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="cart.css">
   <style>
        body {
    padding-top: 65px; /* Adjust this based on navbar height */
}

/* Header Styling */
header {
    background-color: black; /* Black navbar */
    padding: 15px 0;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
}

/* Container Styling */
.container1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Logo Styling */
.logo {
    font-size: 24px;
    color: white;
    font-weight: bold;
}

/* Navigation Menu */
.nav-list {
    list-style: none;
    display: flex;
}

.nav-list li {
    margin-left: 20px;
}

/* Navigation Links */
.nav-list a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    padding: 8px 12px;
    transition: 0.3s;
}

.nav-list a:hover {
    color: #ffcc00; /* Yellow hover effect */
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
            <p style="color: white;">Hi, <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <?php endif; ?>

                <nav>
                    <ul class="nav-list">
                        <li><a href="#">Home</a></li>
                        <li><a href="menu3.php">Menu</a></li>
                        
                        <li><?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart" style="color:white">cart (<span><?php echo $row_count; ?></span>) </a>

      </li>

                        <li><a href="orders.php"><i class="fas fa-clipboard-list"></i> My Orders</a></li>
                        <li><a href="review1.php">Review</a></li>
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
<div class="container">

<section class="shopping-cart">

   <h1 class="heading">cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM cart");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>
    <?php if($fetch_cart['discount'] > 0): ?>
        <span style="text-decoration: line-through; color: #888;">₹<?php echo number_format($fetch_cart['price'], 2); ?></span>
        <span style="color: red; font-weight: bold;">₹<?php echo number_format($fetch_cart['discounted_price'], 2); ?></span>
        <span style="background: #ff9800; color: white; padding: 2px 6px; border-radius: 5px; font-size: 12px;">
            <?php echo $fetch_cart['discount']; ?>% off
        </span>
    <?php else: ?>
        <span style="color: black; font-weight: bold;">₹<?php echo number_format($fetch_cart['price'], 2); ?></span>
    <?php endif; ?>
</td>


            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>₹<?php 
    $item_price = ($fetch_cart['discount'] > 0) ? $fetch_cart['discounted_price'] : $fetch_cart['price'];
    $sub_total = $item_price * $fetch_cart['quantity'];
    echo number_format($sub_total, 2);
?>/-</td>

            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="menu3.php" class="option-btn" style="margin-top: 0;">continue ordering</a></td>
            <td colspan="3">grand total</td>
            <td>₹<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout1.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>
  
</section>

</div>
   
<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>
