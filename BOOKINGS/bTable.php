<?php
session_start();
require_once '../DATABASE/mainDB.php';
require_once '../LOGIN/login.php';
require_once '../MAIN/update_profile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="../MAIN/style.css">
    <link rel="stylesheet" type="text/css" href="../BOOKINGS/booking.css">
    <link rel="icon" type="image/x-icon" href="websiteImage/LogoFP.webp">
    <script src="../BOOKINGS/profile.js"></script>
    <title>Samgyup Paradise</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="headerbar">
                <div class="account">
                    <ul>
                        <a href="../MAIN/main.html">
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
                <?php include 'menu.php'; ?>
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

                    </a>
                </ul>
            </div>
        </div>
    </header>

    <main class="booking-section">
        <div class="booking-container">
            <h2>BOOKING</h2>
            <div style="margin: 20px 0;">
                <h3>Select a Table</h3>
                <div id="tableContainer"></div>
            </div>

            <div class="error-message" id="errorMessage"></div>
            <div class="success-message" id="successMessage"></div>

            <form id="bookingForm" method="POST" action="booking.php" onsubmit="return validateForm()">
                <input type="hidden" id="selectedTable" name="selectedTable">

                <div class="form-field">
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                </div>

                <div class="form-field">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="number" name="phone" id="phone" placeholder="Phone" required>
                </div>

                <div class="form-field">
                    <input type="date" name="booking_date" id="booking_date" placeholder="Date" required>
                    <input type="time" name="booking_time" id="booking_time" placeholder="Time" required>
                </div>

                <div class="form-field large-field">
                    <input type="text" name="additional_notes" id="additional_notes" placeholder="Additional Notes (optional)">
                </div>
                <button type="submit" class="order-button">Book Table</button>
            </form>
        </div>
    </main>

    <script src="../BOOKINGS/bTable.js"></script>
    <script src="../BOOKINGS/profile.js"></script>
    <script src="../BOOKINGS/tableSelection.js"></script>
    <script src="../BOOKINGS/formValidation.js"></script>
    <script src="../MAIN/main.js"></script>
</body>
</html>