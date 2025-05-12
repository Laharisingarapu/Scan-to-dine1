<!DOCTYPE html>
<html>
    <head>
        <title>Restaurant</title>
        <link rel="stylesheet" href="index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dropdownToggle = document.querySelector('.dropdown-toggle');
                dropdownToggle.addEventListener('click', function (event) {
                    event.preventDefault(); 
                    const dropdownMenu = this.nextElementSibling; 
                    dropdownMenu.classList.toggle('show'); 
                });
            });
        </script>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <style>
            html, body {
            overflow-x: hidden;
            }
            .swiper {
                width: 100%;
                height: 550px;
                overflow: hidden;
            }
            .swiper-slide {
                position: relative; /* Ensure the slide is positioned relative */
            }
            .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .swiper-caption {
                position: absolute; /* Position the caption absolutely */
                top: 50%; /* Center vertically */
                left: 50%; /* Center horizontally */
                transform: translate(-50%, -50%); /* Adjust for centering */
                z-index: 2; /* Ensure it is above the image */
            }
            .recipe-section {
                width: 90%;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                column-gap: 10px;
            }
            .welcome-message {
                background-color: rgba(0, 0, 0, 0.7); /* Increased opacity for better visibility */
                padding: 20px;
                border-radius: 10px;
                color: white;
                text-align: center;
                max-width: 900px;
                margin: 0 auto;
                height: 300px;
                width: 600px;
            }
            .swiper-caption1 {
                position: absolute; /* Position the caption absolutely */
                top: 40%; /* Center vertically */
                left: 20%; /* Center horizontally */
                transform: translate(-50%, -50%); /* Adjust for centering */
                z-index: 2; /* Ensure it is above the image */
            }
            .welcome-message1 {
                text-align: left;
                padding: 20px;
                border-radius: 10px;
                color: white;
                text-align: center;
                max-width: 900px;
                margin: 0 auto;
                height: 300px;
                width: 400px;
            }
            .welcome-message1 h1 {
                font-size: 40px;
            }
            .stars {
                font-size: 24px;
                color: gold;
            }
            .review-container {
                display: flex;
                overflow: hidden;
                white-space: nowrap;
                position: relative;
                width: 50%;
            }
            .review-track {
                display: flex;
                gap: 15px;
                animation: scroll 20s linear infinite; /* Auto-scroll effect */
            }
            .card {
                background: white;
                border-radius: 10px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                padding: 15px;
                min-width: 250px;
                border: 1px solid #ddd;
                flex: 0 0 auto;
                transition: transform 0.3s ease-in-out;
            }
            /* Keyframes for infinite scrolling */
            @keyframes scroll {
                0% {
                    transform: translateX(100%);
                }
                100% {
                    transform: translateX(-100%);
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <h1 class="logo">Multi-Cuisine Restaurant</h1>
                <nav>
                    <ul class="nav-list">
                        <li><a href="#">Home</a></li>
                        <li><a href="menu3.php">Menu</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="review1.php">Review</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu" style="min-width: auto;">
                                <li><a href="admin/adminlogin.php" style="color:black"> Admin</a></li>
                                <hr>
                                <li><a href="login.php" style="color:black">User</a></li>
                            </ul>
                        </li>
                        <li><a href="signup.php">SignUp</a></li>
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
            <!-- Swiper -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="3.jpg" alt="Restaurant Interior">
                        <div class="swiper-caption1">
                            <div class="welcome-message1">
                                <h1><b>Savor The Finest Flavors!</b></h1>
                                <p>Indulge in a delightful culinary experience where flavors meet passion. At our restaurant, we bring you a carefully crafted menu filled with fresh ingredients, authentic recipes, and a warm ambiance.
                                <br>
                                <b>Join us and savor the taste of excellence!</b></p>
                                <a href="#1"><button type="button" id="" class="btn btn-primary">Explore More</button></a>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="images/chef.jpg" alt="Our Chef">
                        <div class="swiper-caption">
                            <div class="welcome-message">
                                <h1><b>Meet Our Chef!</b></h1>
                                <p>Behind every delicious dish is the artistry and passion of our expert chef. With years of experience and a deep love for culinary excellence, our chef masterfully blends flavors, techniques, and creativity to craft unforgettable meals. From traditional favorites to innovative creations, each dish is prepared with precision and care to delight your taste buds.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="images/table.jpg" alt="Dining Area">
                        <div class="swiper-caption">
                            <div class="welcome-message">
                                <h1><b>Join Us for a Meal!</b></h1>
                                <p>Step into a world of delicious flavors and warm hospitality. Whether you're craving a comforting classic or an exciting new dish, we invite you to savor every bite in a welcoming ambiance. Gather with family, friends, or colleagues and indulge in a dining experience that’s crafted with passion and served with care.
                                <br>
                                <b>Great food, great company—let’s make every meal special!</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="images/discount3.jpg" alt="Dining Area">
                        <div class="swiper-caption">
                        </div>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <section class="recipes" id="1">
            <h1><b> Featured Menu</b></h1>
            <div class="recipe-section">
                <div class="recipe-card">
                    <img src="images/non-veg.jpeg" alt="">
                    <h2>Non-Veg Items</h2>
                    <p>Savor the rich flavors of our expertly prepared meat dishes.</p>
                    <a href="login.php"> view items</a>
                </div>
                <div class="recipe-card">
                    <img src="images/seafood.jpg" alt="">
                    <h2>Ocean Treasures</h2>
                    <p>Dive into our seafood dishes, from shrimp to flavorful fish.</p>
                    <a href="login.php"> view items</a>
                </div>
                <div class="recipe-card">
                    <img src="images/veg.jpeg" alt="">
                    <h2>Veg Items</h2>
                    <p>Discover delicious and vibrant vegetarian creations, bursting with flavor.</p>
                    <a href="login.php"> view items</a>
                </div>
                <div class="recipe-card">
                    <img src="images/noodles.jpg" alt="">
                    <h2>Fast Food</h2>
                    <p>Indulge in our flavorful noodle dishes and manchuria from classic stir-fries to comforting bowls.</p>
                    <a href="login.php"> view items</a>
                </div>
                <div class="recipe-card">
                    <img src="images/roti-naan.jpg" alt="">
                    <h2>Roti & Naan</h2>
                    <p>Enjoy a selection of freshly baked Indian breads, from fluffy Naan to Roti.</p>
                    <a href="login.php"> view items</a>
                </div>
                <div class="recipe-card">
                    <img src="images/salad.jpeg" alt="">
                    <h2>Salads</h2>
                    <p>Enjoy our vibrant salads, made with the fresh ingredients and light dressings.</p>
                    <a href="login.php"> view items</a>
                </div>
                <div class="recipe-card">
                    <img src="images/dessert.jpeg" alt="">
                    <h2>Desserts & Icecreams</h2>
                    <p>Delicious Desserts</p>
                    <a href="login.php"> view items</a>
                </div>
                <div class="recipe-card">
                    <img src="images/beverages.jpeg" alt="">
                    <h2>Beverages</h2>
                    <p>Cool Beverages</p>
                    <a href="login.php"> view items</a>
                </div>
            </div>
        </section>

        <section>
            <div class="container my-5">
                <div class="row align-items-center">
                    <div class="col-md-6 ">
                        <h1 class="text-center mb-4"><b>About Us</b></h1>
                        <div class="card shadow">
                            <div class="card-body">
                                <h3>Our Story</h3>
                                <p>We started as a small family restaurant with a passion for authentic flavors and exceptional service. Over the years, we've grown into a beloved local establishment, serving our community with pride.</p>
                                <h3>Our Mission</h3>
                                <p>Our mission is to provide our customers with delicious, high-quality meals made from fresh, locally-sourced ingredients. We strive to create a warm and welcoming atmosphere where everyone feels at home.</p>
                                <h3>Our Team</h3>
                                <p>Our dedicated team of chefs and staff work tirelessly to ensure every dish meets our high standards. From our kitchen to your table, we're committed to delivering an unforgettable dining experience.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <br>
                        <img src="images/about.jpg" alt="About Us Image" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </section>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const swiper = new Swiper('.swiper', {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
        <?php include("footer.php"); ?>
    </body>
</html>
