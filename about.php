<!DOCTYPE html>
<html>
<head>
    <title>About Us - Multi-Cuisine Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 63px; /* Adjust this based on navbar height */
            background-color: #f8f9fa; /* Light background for contrast */
        }

        header {
            background-color: black; /* Black navbar */
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
            color: #ffcc00; /* Yellow hover effect */
        }
        .hero {
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
            url('images/dessert-cheesecake.jpg');
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

/* About Section */
.about {
    padding: 50px;
    text-align: center;
    background-color: white;
}

.about-container h2 {
    font-size: 30px;
    font-weight: bold;
}

.about-container p {
    font-size: 18px;
    color: grey;
}
        
    </style>
</head>
<body>
<header>
    <div class="container1">
        <h1 class="logo">Multi-Cuisine Restaurant</h1>
        <nav>
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="menu3.php">Menu</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="review1.php">Review</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero">
        <div class="hero-text">
            <h1>About Us</h1>
        </div>
    </section>

    <!-- About Section -->
  
<div class="container about-section ">
    
    <div class="row">
        <div class="col-md-8 mx-auto">
            
            <h1 class="text-center mb-4"><b>About Our Restaurant</b></h1>
            <p class="text-center">Welcome to our multi-cuisine restaurant, where we serve a variety of delicious dishes made from the freshest ingredients.</p>
             <!-- Update the image source accordingly -->
            <div class="card shadow">
                <div class="card-body">
                    <h3>Our Journey</h3>
                    <p class="lead">
                        Our journey began with a simple idea: to bring people together through the love of food. 
                        We take pride in offering a diverse menu that reflects the rich culinary traditions from around the world.
                    </p>
                    
                    <h3>Our Vision</h3>
                    <p>
                        Our mission is to provide our customers with delicious, high-quality meals 
                        made from fresh, locally-sourced ingredients. We strive to create a warm and 
                        welcoming atmosphere where everyone feels at home.
                    </p>
                    
                    <h3>Meet Our Team</h3>
                    <p>
                        Our talented chefs are passionate about creating memorable dining experiences. 
                        With a focus on quality and creativity, our team is here to serve you with a smile.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "footer.php"; ?> 
