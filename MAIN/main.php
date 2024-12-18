<?php
    session_start();
    require_once '../DATABASE/mainDB.php';
    require_once '../LOGIN/login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../MAIN/style.css">
    <link rel="icon" type="image/x-icon" href="../websiteImage/LogoFP.webp">
    <title>Samgyup Paradise</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="headerbar">
                <div class="account">
                    <ul>
                        <a href="../MAIN/main.php">
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
                        <a href="../LOGIN/login.html">
                            <li>
                                <i class="fa-solid fa-user" id="user-mb"></i>
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="nav">
                    <ul>
                        <a href="../MAIN/main.php">
                            <li>Home</li>
                        </a>
                        <li>
                        <a href="#">Menu</a>
                        <ul class="dropdown">
                            <li><a href="../MENU/menu.php">Pork Menu</a></li>
                            <li><a href="../MENU/beefMenu.php">Beef Menu</a></li>
                            <li><a href="../MENU/chickenMenu.php">Chicken Menu</a></li>
                            <li><a href="../MENU/sideDishes.php">Side Dishes</a></li>
                        </ul>
                        </li>
                        <a href="../MAIN/about.php">
                            <li>About</li>
                        </a>
                        <a href="../BOOKINGS/bTable.php">
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
                    <a href="../MAIN/main.php">
                        <li>Home</li>
                    </a>
                    <li>
                        <a href="#">Menu</a>
                        <ul class="dropdown">
                            <li><a href="../MENU/menu.php">Pork Menu</a></li>
                            <li><a href="../MENU/beefMenu.php">Beef Menu</a></li>
                            <li><a href="../MENU/chickenMenu.php">Chicken Menu</a></li>
                            <li><a href="../MENU/sideDishes.php">Side Dishes</a></li>
                        </ul>
                    </li>
                    <a href="../MAIN/about.php">
                        <li>About</li>
                    </a>
                    <a href="../BOOKINGS/bTable.php">
                        <li>Book Table</li>
                    </a>
                </ul>
            </div>
            <div class="account">
                <ul>
                    <a href="../MAIN/main.php">
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
                    <li class="dropdown-user">
                                <a href="../LOGIN/login.html"><i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown">
                            <li class="user-info">
                            <img src="<?php echo isset($_SESSION['profilePicture']) && !empty($_SESSION['profilePicture']) 
                            ? '../websiteImage/' . $_SESSION['profilePicture'] 
                            : 'websiteImage/default.png'; ?>" 
                            alt="Profile Picture" 
                            class="profile-picture">
                                <?php if (isset($_SESSION['fullName'])): ?>
                                <span id="dropdownUserName" class="user-name"><a href="../MAIN/profile.php"><?php echo htmlspecialchars($_SESSION['fullName']); ?></a></span>
                                <?php else: ?>
                                    <a href="../LOGIN/login.html">Login</a>
                                <?php endif; ?>
                            </li>
                            <li><a href="../MAIN/profile.php">Profile</a></li>
                            <li><a href="../LOGIN/logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="home">
        <div class="main_slide">
            <div>
                <a href="../MENU/menu.php">
                <h1>Welcome to <span>Samgyup</span> Paradise</h1>
                <p>Your Ultimate Destination for Authentic Korean BBQ Delights! Grill, Savor, and Enjoy the Perfect Samgyupsal Experience with Premium Cuts, Fresh Ingredients, and Unmatched Flavors.</p>

                <button class="red_btn">Visit Now <i class="fa-solid fa-arrow-right-long"></i></button>
                </a>
            </div>
            <div>
                <img src="../websiteImage/samgImage.png" alt="samgImage">
            </div>
        </div>
    </div>

    <footer class="footer1">
        <div class="footer-container">
            <div class="dine-with-us">
                <h2>Dine With Us</h2>
                <h2>Book A Table</h2>
                <img src="../websiteImage/reserve-table.webp" alt="Dine Table" class="table-img">
            </div>
    
            <div class="footer-right">
                <div class="reserve">
                    <a href="../BOOKINGS/bTable.php">
                    <h2>Reserve Online</h2>
                    <p>Book a table online at Samgyup Paradise.</p>
                    <button class="book-now-btn">Book Now</button>
                    </a>
                </div>
            </div>
            <div class="opening-times">
                <h2>Opening Times</h2>
                <h3>Tuesday - Thursday</h3>
                <p>17:00 - 22:30</p>
                <h3>Friday</h3>
                <p>17:00 - 23:00</p>
                <h3>Saturday</h3>
                <p>12:00 - 23:00</p>
                <h3>Sunday</h3>
                <p>12:00 - 22:00</p>
            </div>
        </div>
    </footer>
    
    <footer class="footer2">
        <div class="footer-container2">
            <div class="webFooter">
                <h2>SAMGYUP PARADISE</h2>
                <p>&copy;Unlimited Samgyup Since 2024.</p>
            </div>

        <div class="footer-right2">
            <h2>Quick Links</h2>
            <a href="https://www.facebook.com/johnloyd.wasquin.1?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://myaccount.google.com/u/2/?gar=WzJd&hl=en&utm_source=OGB&utm_medium=act"><i class="fa-brands fa-google"></i></a>
            <a href="https://github.com/JohnLoydWasquin/SmartRestaurantOrderingandInventorySystemAutomateOrdersandTrackInventoryinReal-Time">
            <i class="fa-brands fa-github"></i></a>
        </div>
        <div class="footer-right3">
            <h2>For Inquiries</h2>
            <a href="mailto:johnloydwasquin27@gmail.com">samgparadise27@gmail.com</a>
            <br>
            <a href="mailto:johnloydwasquin27@gmail.com">johnloydwasquin27@gmail.com</a>
            <br>
            <a href="mailto:toledodyuleeann@gmail.com">toledodyuleeann@gmail.com</a>
            <br>
            <a href="mailto:plvergaraben17@gmail.com">plvergaraben17@gmail.com</a>
        </div>
    </div>
    </footer>
    <script src="../MAIN/main.js"></script>
</body>
</html>