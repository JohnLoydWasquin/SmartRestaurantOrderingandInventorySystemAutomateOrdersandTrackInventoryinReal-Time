<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../DATABASE/mainDB.php';
require_once '../LOGIN/login.php';
require_once '../MAIN/update_profile.php';

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
                    <a href="../MAIN/bTable.html">
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
                <a href="../MAIN/bTable.html">
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
                            <span id="dropdownUserName" class="user-name"><a href="../MAIN/profile.html"><?php echo htmlspecialchars($_SESSION['fullName']); ?></a></span>
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

<main class="profile-container">
    <div class="container py-5">
        <div class="row">
            <!-- Profile Information -->
            <div class="col-lg-4 mb-4">
                <div class="profile-card">
                    <div class="profile-header">
                    <img src="<?php echo isset($_SESSION['profilePicture']) && !empty($_SESSION['profilePicture']) 
                            ? '../websiteImage/' . $_SESSION['profilePicture'] 
                            : 'websiteImage/default.png'; ?>" 
                            alt="Profile Picture" 
                            class="profile-picture">
                        <h2><?php echo isset($_SESSION['fullName']) ? $_SESSION['fullName'] : 'Guest'; ?></h2>
                    </div>
                    <div class="profile-info">
                        <p><i class="fas fa-envelope"></i> <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'Not available'; ?></p>
                        <p><i class="fas fa-phone"></i> <?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : 'Not available'; ?></p>
                        <p><i class="fas fa-calendar"></i> Member since: <?php echo isset($_SESSION['joinDate']) ? date('F Y', strtotime($_SESSION['joinDate'])) : 'Not available'; ?></p>
                        <button class="edit-btn" onclick="toggleEditForm()">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>

<!-- Edit Profile Form (Initially Hidden) -->
<div class="col-lg-8 mb-4" id="editProfileForm" style="display: none;">
    <div class="content-card">
        <h3><i class="fas fa-user-edit"></i> Edit Profile</h3>
        <form action="../MAIN/update_profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName"
                        value="<?php echo htmlspecialchars($_SESSION['firstName'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <input type="text" class="form-control" id="lastName" name="lastName"
                        value="<?php echo htmlspecialchars($_SESSION['lastName'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo htmlspecialchars($_SESSION['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone"
                        value="<?php echo htmlspecialchars($_SESSION['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="profilePicture">Profile Picture</label>
                <input type="file" class="form-control" id="profilePicture" name="profilePicture">
            </div>
            <div class="button-group">
                <button type="submit" class="save-btn">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <button type="button" class="cancel-btn" onclick="toggleEditForm()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

                <!-- Order History -->
                <div class="col-lg-8" id="orderHistory">
                    <div class="content-card">
                        <h3><i class="fas fa-history"></i> Order History</h3>
                        <div class="order-list">
                            <?php
                            // Assuming you have a function to fetch orders from the database
                            $orders = []; // Replace with actual database query
                            if (empty($orders)) {
                                echo '<div class="no-orders">No orders found</div>';
                            } else {
                                foreach ($orders as $order) {
                                    // Display each order
                                }
                            }
                            ?>
                            <!-- Sample Order Cards -->
                            <div class="order-card">
                                <div class="order-header">
                                    <h4>Order #12345</h4>
                                    <span class="order-status delivered">Delivered</span>
                                </div>
                                <div class="order-details">
                                    <p><i class="fas fa-calendar"></i> Date: May 15, 2023</p>
                                    <p><i class="fas fa-money-bill"></i> Total: ₱999.99</p>
                                </div>
                                <button class="view-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>

                            <div class="order-card">
                                <div class="order-header">
                                    <h4>Order #12346</h4>
                                    <span class="order-status processing">Processing</span>
                                </div>
                                <div class="order-details">
                                    <p><i class="fas fa-calendar"></i> Date: June 2, 2023</p>
                                    <p><i class="fas fa-money-bill"></i> Total: ₱1,299.50</p>
                                </div>
                                <button class="view-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../MAIN/main.js"></script>
</body>
</html>