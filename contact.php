<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - Multi-Cuisine Restaurant</title>
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
            url('images/vegbiryani.jpg');
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
        <nav>
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="menu3.php">Menu</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="review1.php">Review</a></li>
                <li><a href="login.php">Login</a></li>
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
            <h1>Contact Us</h1>
        </div>
    </section>


<div class="container ">
    <div class="row">
        <div class="col-md-8 mx-auto">
        <h1 class="text-center mb-4"><b>Contact Us</b></h1>
        <p class="text-center">Welcome to our multi-cuisine restaurant, where we serve a variety of delicious dishes made from the freshest ingredients.</p>
            <div class="card shadow">
                <div class="card-body">
                    <h3>Get in Touch</h3>
                    <p class="lead">
                        We'd love to hear from you! Whether you have a question, feedback, or just 
                        want to say hello, our team is here to help.
                    </p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Contact Information</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-map-marker-alt"></i>Warangal, Telangana, India</li>
                                <li><i class="fas fa-phone"></i> +91 9676594239</li>
                                <li><i class="fas fa-envelope"></i>  singarapulahari@gmail.com</li>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <h4>Opening Hours</h4>
                            <ul class="list-unstyled">
                                <li>Monday - Friday: 11:00 AM - 10:00 PM</li>
                                <li>Saturday: 10:00 AM - 11:00 PM</li>
                                <li>Sunday: 10:00 AM - 9:00 PM</li>
                            </ul>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<?php include "footer.php"; ?> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

