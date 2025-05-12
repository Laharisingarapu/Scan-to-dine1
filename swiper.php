<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

            <section>
            <?php
            include 'connection.php'; // Database connection

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $review = $_POST['rev'];
                $rating = $_POST['desc'];
                
                $sql = "INSERT INTO review (name, review, description) VALUES ('$name', '$review', '$rating')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Review submitted successfully!'); window.location.href='index.php';</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
            ?>

            <!-- PHP: Fetch & Display Reviews Dynamically -->
            <div class="container my-5">
                <div class="row ">
                    <h2 class="text-left">Customer Reviews</h2>
                    <div class="review-container">
                        <div class="review-track">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='card my-3 text-center'>
                                        <div class='card-body'>
                                            <h5 class='card-title fw-bold'>{$row['name']}</h5>
                                            <p class='card-text'>{$row['review']}</p>
                                            <p class='text-warning fs-4'>" . str_repeat('★', $row['description']) . str_repeat('☆', 5 - $row['description']) . "</p>
                                        </div>
                                    </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
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
        </body>
        </html>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwiperJS Card Slider</title>
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <style>
        /* Background Gradient */
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Swiper Container */
        .swiper {
            width: 80%;
            padding: 40px 0;
        }

        /* Swiper Slide */
        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card Styling */
        .card {
            width: 250px;
            height: 350px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 15px;
            font-size: 16px;
            text-align: center;
        }

        /* Swiper Buttons */
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
        }

        /* Pagination */
        .swiper-pagination-bullet {
            background: white;
            opacity: 0.7;
        }

        .swiper-pagination-bullet-active {
            background: #fff;
        }
    </style>
</head>
<body>

    <!-- Swiper Container -->
    <div class="swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="card">
                    <img src="https://source.unsplash.com/400x500/?beach" alt="Beach">
                    <div class="card-content">Enjoy the Exotic Beaches</div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="card">
                    <img src="https://source.unsplash.com/400x500/?mountains" alt="Mountains">
                    <div class="card-content">Breathtaking Mountain Views</div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="card">
                    <img src="https://source.unsplash.com/400x500/?city" alt="City">
                    <div class="card-content">Explore Vibrant Cities</div>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="swiper-slide">
                <div class="card">
                    <img src="https://source.unsplash.com/400x500/?forest" alt="Forest">
                    <div class="card-content">Walk Through Lush Forests</div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var swiper = new Swiper('.swiper', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                slidesPerView: 1.5,
                spaceBetween: 20,
                centeredSlides: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                }
            });
        });
    </script>

</body>
</html>
