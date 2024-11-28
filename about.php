<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="websiteImage/LogoFP.webp">
    <title>About Us - Samgyup Paradise</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="headerbar">
                <div class="account">
                    <ul>
                        <a href="main.html">
                            <li>
                                <i class="fa-solid fa-house-chimney"></i>
                            </li>
                        </a>
                        <a href="#">
                             <li>
                                <i class="fa-solid fa-magnifying-glass searchicon" id="searchicon1"></i>
                             </li>
                        </a>
                        <div class="search" id="searchinput1">
                            <input type="search" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass srchicon"></i>
                        </div>
                        <a href="login.html">
                            <li>
                                <i class="fa-solid fa-user" id="user-mb"></i>
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="nav">
                    <ul>
                        <a href="main.html">
                            <li>Home</li>
                        </a>
                        <li>
                        <a href="#">Menu</a>
                        <ul class="dropdown">
                            <li><a href="#">Pork Menu</a></li>
                            <li><a href="#">Beef Menu</a></li>
                            <li><a href="#">Chicken Menu</a></li>
                            <li><a href="#">Side Dishes</a></li>
                        </ul>
                        </li>
                        <a href="about.php">
                            <li>About</li>
                        </a>
                        <a href="bTable.php">
                            <li>Book Table</li>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="logo">
                <h2>SAMGYUP PARADISE</h2>
            </div>
            <div class="bar">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark" id="hdcross"></i>
            </div>
            <div class="nav">
                <ul>
                    <a href="main.html">
                        <li>Home</li>
                    </a>
                    <li>
                        <a href="#">Menu</a>
                        <ul class="dropdown">
                            <li><a href="menu.php">Pork Menu</a></li>
                            <li><a href="beefMenu.html">Beef Menu</a></li>
                            <li><a href="chickenMenu.html">Chicken Menu</a></li>
                            <li><a href="sideDishes.html">Side Dishes</a></li>
                        </ul>
                    </li>
                    <a href="about.php">
                        <li>About</li>
                    </a>
                    <a href="bTable.php">
                        <li>Book Table</li>
                    </a>
                </ul>
            </div>
            <div class="account">
                <ul>
                    <a href="main.html">
                        <li>
                            <i class="fa-solid fa-house-chimney"></i>
                        </li>
                    </a>
                    <a href="#">
                        <li>
                            <i class="fa-solid fa-magnifying-glass searchicon" id="searchicon2"></i>
                        </li>
                    </a>
                    <div class="search" id="searchinput2">
                        <input type="search" placeholder="Search...">
                        <i class="fa-solid fa-magnifying-glass srchicon"></i>
                    </div>
                    <a href="login.html">
                        <li>
                            <i class="fa-solid fa-user" id="user-lap"></i>
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </header>
          <!-- background-section  -->
    <div class="background-section ">
        <div class="text-container">
            <h1>ABOUT US.</h1>
        </div>
    </div>
    <!-- Our Story Section -->
    <div class="our-story">
        <h2>Our Story</h2>
        <p>Three university students—Johnloyd, Paul, and Julie—decided to use their skills in technology and business to create a website promoting local restaurants. Their first client was **Samgyup Paradise**, a Korean BBQ spot they loved. After discussing the idea with the owner, Hana, they built a website that highlighted the restaurant's story and mission.

        Samgyup Paradise was founded to offer authentic Korean BBQ while creating a space for people to connect over great food. The students designed a website that showcased the restaurant’s diverse menu and welcoming atmosphere, which helped attract new customers. Through this project, the students learned that the most successful websites are those that tell meaningful stories, connecting people, culture, and food in a powerful way.</p>
    </div>
         <!-- Carousel Section -->
         <div class="carousel">
            <div class="carousel-images">
                <img src="websiteImage/Lifestyle-Photo-2.jpg" alt="Restaurant Image 1">
                <img src="websiteImage/Lifestyle-Photo-4.jpg" alt="Restaurant Image 2">
                <img src="websiteImage/Delicious-Future.jpg" alt="Restaurant Image 3">
            </div>
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
        <div class="our-story">
        <p>More than just a restaurant, Samgyup Paradise has become a beloved gathering place for friends, families, and food lovers alike. Whether you're celebrating a special occasion or simply enjoying a night out with loved ones, our welcoming atmosphere and commitment to excellence ensure that every visit is an unforgettable experience. As we continue to grow, we remain dedicated to upholding the values of quality, authenticity, and community that have made us a favorite destination for those seeking not just a meal, but a celebration of food, culture, and togetherness.</p>
    </div>
    <!-- Zoom-In Images Below Carousel -->
    <div class="zoom-images">
            <img src="websiteImage/599.jpg" alt="Image 1">
            <img src="websiteImage/kfood4.jpg" alt="Image 2">
            <img src="websiteImage/kfood3.jpg" alt="Image 3">
            <img src="websiteImage/kfood2.jpg" alt="Image 4">
        </div>
    </div>
     <!-- Mechanics Section -->
     <div class="mechanics">
        <h2>Samgyup Paradise Promo Mechanics</h2>
        <ul>
            <li>1. Unlimited P599 K-BBQ is a choice of unlimited variants of pork, beef, chicken and k-fried chicken balls along with an unlimited choice of side dishes, sauces and iced tea.</li>
            <li>2. This promotion is valid for dine-in customers only.</li>
            <li>3. Minimum of 2 people per table is required to avail of the promo.</li>
            <li>4. Promo valid on weekdays only (Monday to Friday).</li>
            <li>5. Present your discount code upon ordering to get a 10% discount.</li>
            <li>6. Not valid in conjunction with other discounts or promotions.</li>
            <li>7. In the purchase of goods and services which are on promotional discount, the senior citizen can avail the promotional discount or the discount provided under the Expanded Senior Citizens Act of 2020, whichever is higher.</li>
            <li>8. This promo is valid for one person per promo.</li>
        </ul>
    </div>
    <!-- Customer Reviews -->
    <div class="reviews">
        <h2>What Our Customers Say</h2>
        <div class="review">
            <p>"The best Korean BBQ I've had in a long time! The flavors are amazing and the service is top-notch!"</p>
            <span class="customer">- John Doe</span>
        </div>
        <div class="review">
            <p>"A paradise for meat lovers! Highly recommend the pork belly and beef ribs. Worth every penny."</p>
            <span class="customer">- Jane Smith</span>
        </div>
        <div class="review">
            <p>"An unforgettable dining experience. The ambiance is perfect for family and friends gatherings!"</p>
            <span class="customer">- Mark Lee</span>
        </div>
    </div>
       
    <!-- Centered Button Section with Link -->
    <a href="menu.php">
        <button class="red_btn">
        <i class="fa fa-arrow-right"></i> View Menu
        </button>

    </a>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Samgyup Paradise | <a href="privacy-policy.html">Privacy Policy</a> | <a href="contact.html">Contact Us</a></p>
    </footer>

    
</body>

<script src="main.js"></script>
</html>