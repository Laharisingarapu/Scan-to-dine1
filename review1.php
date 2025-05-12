
<?php
 // Start the session
session_start();
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['email']); // Assuming user email is stored in session

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: auto;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }
        .text-warning {
            font-size: 18px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
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
.hero {
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
            url('images/review.jpg');
    height: 450px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-size: cover;
    background-position: center;
    text-align: center;
    
}

.hero-text h1 {
    font-size: 50px;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
    z-index: 1;
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu3.php">Menu</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="about.php">About</a></li>
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
        <section class="hero">
        <div class="hero-text">
            <h1>Reviews</h1>
        </div>
    </section>
    <br>
<div class="container my-5">
    <h2 class="text-center">Submit Your Review</h2>
    <form action="submit_review.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea class="form-control" id="review" name="rev" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select class="form-select" name="desc" required>
                <option value="5">★★★★★</option>
                <option value="4">★★★★☆</option>
                <option value="3">★★★☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="1">★☆☆☆☆</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Review</button>
    </form>
</div>

<!-- PHP: submit_review.php (Handles Form Submission) -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
