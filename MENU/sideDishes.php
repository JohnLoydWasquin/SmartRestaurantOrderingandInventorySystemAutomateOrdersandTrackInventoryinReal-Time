<?php
session_start();
require_once '../DATABASE/mainDB.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=samgyup_paradise", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT menu_id, menu_name, description, price, category, quantity FROM menus WHERE category = 'Side Dish'");
    $stmt->execute();
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($menu_items)) {
        $menu_items = [
            [
                'menu_id' => 1,
                'menu_name' => 'Odeng-Fishcake',
                'description' => 'Savory fish cakes.',
                'category' => 'Side Dish',
                'quantity' => 100
            ],
            [
                'menu_id' => 2,
                'menu_name' => 'Onion-Sauce',
                'description' => 'A sweet condiment.',
                'category' => 'Side Dish',
                'quantity' => 100
            ],
            [
                'menu_id' => 3,
                'menu_name' => 'Kimchi',
                'description' => 'Spicy, tangy, fermented fun.',
                'category' => 'Side Dish',
                'quantity' => 100
            ],
            [
                'menu_id' => 4,
                'menu_name' => 'Japchae',
                'description' => 'A vibrant stir-fried noodle.',
                'category' => 'Side Dish',
                'quantity' => 100
            ],
            [
                'menu_id' => 5,
                'menu_name' => 'Potato Marbles',
                'description' => 'Sweet and savory potato.',
                'category' => 'Side Dish',
                'quantity' => 100
            ],
            [
                'menu_id' => 6,
                'menu_name' => 'Raddish Pickle',
                'description' => 'A crisp radish pickled.',
                'category' => 'Side Dish',
                'quantity' => 100
            ],
            [
                'menu_id' => 7,
                'menu_name' => 'Pamuchim',
                'description' => 'Thinly sliced green onions.',
                'category' => 'Side Dish',
                'quantity' => 100
            ],
            [
                'menu_id' => 8,
                'menu_name' => 'Water Spanich',
                'description' => 'Blanched water spinach.',
                'category' => 'Side Dish',
                'quantity' => 100
            ]
        ];
    }
} catch (PDOException $e) {
    $menu_items = [
        [
            'menu_id' => 1,
            'menu_name' => 'Odeng-Fishcake',
            'description' => 'Savory fish cakes.',
            'category' => 'Side Dish',
            'quantity' => 100
        ],
        [
            'menu_id' => 2,
            'menu_name' => 'Onion-Sauce',
            'description' => 'A sweet condiment.',
            'category' => 'Side Dish',
            'quantity' => 100
        ],
        [
            'menu_id' => 3,
            'menu_name' => 'Kimchi',
            'description' => 'Spicy, tangy, fermented fun.',
            'category' => 'Side Dish',
            'quantity' => 100
        ],
        [
            'menu_id' => 4,
            'menu_name' => 'Japchae',
            'description' => 'A vibrant stir-fried noodle.',
            'category' => 'Side Dish',
            'quantity' => 100
        ],
        [
            'menu_id' => 5,
            'menu_name' => 'Potato Marbles',
            'description' => 'Sweet and savory potato.',
            'category' => 'Side Dish',
            'quantity' => 100
        ],
        [
            'menu_id' => 6,
            'menu_name' => 'Raddish Pickle',
            'description' => 'A crisp radish pickled.',
            'category' => 'Side Dish',
            'quantity' => 100
        ],
        [
            'menu_id' => 7,
            'menu_name' => 'Pamuchim',
            'description' => 'Thinly sliced green onions.',
            'category' => 'Side Dish',
            'quantity' => 100
        ],
        [
            'menu_id' => 8,
            'menu_name' => 'Water Spanich',
            'description' => 'Blanched water spinach.',
            'category' => 'Side Dish',
            'quantity' => 100
        ]
    ];
    error_log("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../MAIN/style.css">
    <link rel="icon" type="image/x-icon" href="../websiteImage/LogoFP.webp">
    <title>Chicken Menu - Samgyup Paradise</title>
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

<div class="menu-section" id="menu">
    <h1>UNLI <span>SAMGYUPSAL</span> MENU</h1>
    <div class="menu-category">
        <span class="category-label">SIDE DISHES</span>
    </div>
    <div class="menu-items">
        <?php foreach ($menu_items as $item): ?>
            <div class="menu-item">
                <img src="../websiteImage/sideDishes<?php echo $item['menu_id']; ?>.png" alt="<?php echo htmlspecialchars($item['menu_name']); ?>">
                <h3><?php echo htmlspecialchars($item['menu_name']); ?></h3>
                <p><?php echo htmlspecialchars($item['description']); ?></p>
                <form action="../MENU/add_to_cart.php" method="POST">
                    <input type="hidden" name="menu_id" value="<?php echo htmlspecialchars($item['menu_id']); ?>">
                    <input type="hidden" name="menu_name" value="<?php echo htmlspecialchars($item['menu_name']); ?>">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="../MAIN/main.js"></script>
</body>
</html>
