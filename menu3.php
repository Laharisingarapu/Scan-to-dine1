<?php
include("connection.php"); // Include the database connection

@include 'config.php';

session_start();


if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_discount = isset($_POST['product_discount']) ? $_POST['product_discount'] : 0;

// If no discount, keep the original price
$discounted_price = ($product_discount > 0) ? $product_price - ($product_price * $product_discount / 100) : $product_price;
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity,discount, discounted_price) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity','$product_discount','$discounted_price')");
      $message[] = 'product added to cart successfully';
   }

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
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="cart.css">
   <style>
        
        /* Fix Navbar Overlapping Content */
body {
    padding-top: 63px; /* Adjust this based on navbar height */
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
.search {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    width: 200px;
  }
  .discount {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    width: 200px;
  }
  .main-container {
    display: flex;
}

.sidebar {
    width: 250px;
    background-color: #2c3e50;
    color: white;
    padding: 20px;
    height: 100vh;
    position: sticky;
    top: 0;
}

.sidebar h2 {
    margin-bottom: 2rem;
    font-size: 1.5rem;
    border-bottom: 2px solid #34495e;
    padding-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 8px;
    border-radius: 5px;
    transition: 0.3s;
}

.sidebar ul li a:hover {
    background-color: #3498db;
}

/* Adjust content area to make space for sidebar */
.content {
    flex-grow: 1;
    padding: 20px;
}
.price {
    font-size: 18px;
    font-weight: bold;
    margin-top: 5px;
}

.discount-badge {
    background-color: #ff9800;
    color: white;
    padding: 3px 6px;
    border-radius: 4px;
    font-size: 12px;
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
  .mobile-menu-btn {
    display: none;
    position: fixed;
    top: 1rem;
    left: 1rem;
    z-index: 1000;
    background: white;
    border: none;
    padding: 0.5rem;
    border-radius: 0.375rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    cursor: pointer;
}
.products .box-container{
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
   gap: 2rem;
   justify-content: center;
  
   
}
.products .box-container .box {
   display: flex;
   flex-direction: column;
   justify-content: space-between;
   height: 100%; /* Ensure card stretches fully */
   min-height: 500px; /* <- adjust as needed */
   text-align: center;
   padding: 2rem;
   box-shadow: var(--box-shadow);
   border: var(--border);
   border-radius: .5rem;
   background-color: var(--white);
}
.products .box-container .box .price{
   font-size: 1.8rem;
   color:var(--black);
}
.products .box-container .box h3,
.products .box-container .box h4 {
   display: -webkit-box;
   -webkit-line-clamp: 2;  /* show max 2 lines */
   -webkit-box-orient: vertical;
   overflow: hidden;
   text-overflow: ellipsis;
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
@media (max-width: 1024px) {
    .main-container {
        grid-template-columns: 1fr;
    }

    .mobile-menu-btn {
        display: block;
        top: 80px;
    }

    .sidebar {
        position: fixed;
        left: -250px;
        transition: left 0.3s ease;
        z-index: 999;
    }

    .sidebar.active {
        left: 0;
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
                        <li><a href="index.php">Home</a></li>
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
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>


<div class="main-container">
<button id="mobile-menu-btn" class="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
    <h2><i class="fas fa-utensils"></i> Categories</h2>
        <ul>
            <?php
            // Fetch categories from the database
            $select_categories = mysqli_query($conn, "SELECT * FROM categories");
            while($fetch_category = mysqli_fetch_assoc($select_categories)){
            ?>
            <li><a href="?category=<?php echo $fetch_category['id']; ?>"><?php echo $fetch_category['name']; ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>

    <!-- Products Section -->
    <div class="content">
        <section class="products">
        <form method="get" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
    <h2>Search</h2>
    <input type="text" name="search_query" placeholder="Search products" value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>" class="search">
    <select name="rating" class="search" style="min-width: 150px;">
        <option value=""><h2>Min Rating</h2></option>
        <option value="1" <?php if(isset($_GET['rating']) && $_GET['rating'] == 1) echo 'selected'; ?>>1★ and up</option>
        <option value="2" <?php if(isset($_GET['rating']) && $_GET['rating'] == 2) echo 'selected'; ?>>2★ and up</option>
        <option value="3" <?php if(isset($_GET['rating']) && $_GET['rating'] == 3) echo 'selected'; ?>>3★ and up</option>
        <option value="4" <?php if(isset($_GET['rating']) && $_GET['rating'] == 4) echo 'selected'; ?>>4★ and up</option>
        <option value="5" <?php if(isset($_GET['rating']) && $_GET['rating'] == 5) echo 'selected'; ?>>5★ only</option>
    </select>
    <h2 >Price Range</h2>
    <input type="number" name="min_price" placeholder="Min" style="width: 80px;border: 2px solid #ccc;padding: 10px;" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">
    <input type="number" name="max_price" placeholder="Max" style="width: 80px;border: 2px solid #ccc;padding: 10px;" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">
    <h2>Discount</h2>
<select name="discount" class="discount" id="discount" style="min-width: 150px;">
    <option value="">Select Discount</option>
    <option value="10" <?php if(isset($_GET['discount']) && $_GET['discount'] == "10") echo "selected"; ?>>10% or more</option>
    <option value="20" <?php if(isset($_GET['discount']) && $_GET['discount'] == "20") echo "selected"; ?>>20% or more</option>
    <option value="30" <?php if(isset($_GET['discount']) && $_GET['discount'] == "30") echo "selected"; ?>>30% or more</option>
    <option value="40" <?php if(isset($_GET['discount']) && $_GET['discount'] == "40") echo "selected"; ?>>40% or more</option>
    <option value="50" <?php if(isset($_GET['discount']) && $_GET['discount'] == "50") echo "selected"; ?>>50% or more</option>
</select>



    <br><br>
    <div style="margin-top: 1rem;">
    <button type="submit" style="padding: 5px 10px; background-color: #3498db; color: white; border: none; border-radius: 5px;">Apply Filters</button>
    <a href="menu3.php" style="margin-left: 10px; padding: 5px 10px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Clear Filters</a>
</div>

</form>

            <h1 class="heading">Menu</h1>
            
            <div class="box-container">
                <?php
                $search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';
                $category_id = isset($_GET['category']) ? $_GET['category'] : '';
                
                // Fetch products based on selected category or search query
                 // Fetch products based on selected category or search query
                 $where = [];

                 if (!empty($_GET['category'])) {
                     $category_id = $_GET['category'];
                     $where[] = "category_id = '".mysqli_real_escape_string($conn, $category_id)."'";
                 }
                 
                 if (!empty($_GET['search_query'])) {
                     $search_query = $_GET['search_query'];
                     $where[] = "name LIKE '%".mysqli_real_escape_string($conn, $search_query)."%'";
                 }
                 
                 if (!empty($_GET['min_price'])) {
                     $min_price = (float) $_GET['min_price'];
                     $where[] = "price >= $min_price";
                 }
                 
                 if (!empty($_GET['max_price'])) {
                     $max_price = (float) $_GET['max_price'];
                     $where[] = "price <= $max_price";
                 }
                 if (!empty($_GET['discount'])) {
                     $min_discount = (int) $_GET['discount'];
                     $where[] = "discount >= $min_discount";
                 }
                 if (!empty($_GET['rating'])) {
                    $rating = (int) $_GET['rating'];
                    $where[] = "rating >= $rating";
                }
                 $where_sql = '';
                 if (!empty($where)) {
                     $where_sql = "WHERE " . implode(" AND ", $where);
                 }
                 
                 $select_products = mysqli_query($conn, "SELECT * FROM menu_items $where_sql");
 

                if(mysqli_num_rows($select_products) > 0) {
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                ?>
                <form action="" method="post">
                    <div class="box">
                        <img src="<?php echo $fetch_product['image_url']; ?>" alt="">
                        <h3><?php echo $fetch_product['name']; ?></h3>
                        <h5 style="font-size:15px"><?php echo $fetch_product['description']; ?></h5>
                        <p style="color: #ff9800;">
    <?php
        $stars = floor($fetch_product['rating']);
        for ($i = 0; $i < $stars; $i++) echo '★';
        for ($i = $stars; $i < 5; $i++) echo '☆';
    ?>
</p>

                        <?php
   $original_price = $fetch_product['price'];
   $discount = $fetch_product['discount'];
   $discounted_price = $original_price - ($original_price * $discount / 100);
?>
<div class="price">
    ₹<span style="text-decoration: line-through; color: #888;"><?php echo number_format($original_price, 2); ?></span> 
    <span style="color: red; font-weight: bold;">₹<?php echo number_format($discounted_price, 2); ?></span>
    <span style="background: #ff9800; color: white; padding: 2px 6px; border-radius: 5px; font-size: 12px;">
        <?php echo $discount; ?>% off
    </span>
</div>

                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_discount" value="<?php echo $fetch_product['discount']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image_url']; ?>">
                        <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
                    </div>
                </form>
                <?php
                    };
                };
                ?>
            </div>
        </section>
    </div>
</div>

<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>
