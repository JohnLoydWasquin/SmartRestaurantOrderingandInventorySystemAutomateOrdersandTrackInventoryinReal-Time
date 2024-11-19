<?php
session_start();
require_once 'mainDB.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=samgyup_paradise", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT menu_id, menu_name, description, price, category, quantity FROM menus WHERE category = 'Pork'");
    $stmt->execute();
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($menu_items)) {
        $menu_items = [
            [
                'menu_id' => 1,
                'menu_name' => 'Original Fried Chicken Balls',
                'description' => 'Golden and crispy bite-sized chicken pieces.',
                'price' => 199,
                'category' => 'Chicken',
                'quantity' => 100
            ],
            [
                'menu_id' => 2,
                'menu_name' => 'Yangnyum Chicken Balls',
                'description' => 'Fried chicken balls coated in a sweet and spicy sauce.',
                'price' => 449,
                'category' => 'Chicken',
                'quantity' => 100
            ],
            [
                'menu_id' => 3,
                'menu_name' => 'Gochujang Chicken Balls',
                'description' => 'Crispy chicken balls tossed in a gochujang-based sauce.',
                'price' => 349,
                'category' => 'Chicken',
                'quantity' => 100
            ],
            [
                'menu_id' => 4,
                'menu_name' => 'Honey Soy Garlic Chicken',
                'description' => 'Crispy, juicy goodness of bite-sized chicken pieces.',
                'price' => 349,
                'category' => 'Chicken',
                'quantity' => 100
            ]
        ];
    }
} catch (PDOException $e) {
    $menu_items = [
        [
            'menu_id' => 1,
            'menu_name' => 'Original Fried Chicken Balls',
            'description' => 'Golden and crispy bite-sized chicken pieces.',
            'price' => 199,
            'category' => 'Chicken',
            'quantity' => 100
        ],
        [
            'menu_id' => 2,
            'menu_name' => 'Yangnyum Chicken Balls',
            'description' => 'Fried chicken balls coated in a sweet and spicy sauce.',
            'price' => 449,
            'category' => 'Chicken',
            'quantity' => 100
        ],
        [
            'menu_id' => 3,
            'menu_name' => 'Gochujang Chicken Balls',
            'description' => 'Crispy chicken balls tossed in a gochujang-based sauce.',
            'price' => 349,
            'category' => 'Chicken',
            'quantity' => 100
        ],
        [
            'menu_id' => 4,
            'menu_name' => 'Honey Soy Garlic Chicken',
            'description' => 'Crispy, juicy goodness of bite-sized chicken pieces.',
            'price' => 349,
            'category' => 'Chicken',
            'quantity' => 100
        ]
    ];
    error_log("Database connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['total_cost'])) {
    $_SESSION['total_cost'] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="websiteImage/LogoFP.webp">
    <title>Chicken Menu - Samgyup Paradise</title>
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
                            <li><a href="menu.php">Pork Menu</a></li>
                            <li><a href="beefMenu.php">Beef Menu</a></li>
                            <li><a href="chickenMenu.php">Chicken Menu</a></li>
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
                            <li><a href="beefMenu.php">Beef Menu</a></li>
                            <li><a href="chickenMenu.php">Chicken Menu</a></li>
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

<div class="menu-section" id="menu">
    <h1>UNLI <span>SAMGYUPSAL</span> MENU</h1>
    <div class="menu-category">
        <span class="category-label">CHICKEN MENU</span>
    </div>
    <div class="menu-items">
        <?php foreach ($menu_items as $item): ?>
            <div class="menu-item">
                <img src="websiteImage/chickenmenu<?php echo $item['menu_id']; ?>.png" alt="<?php echo htmlspecialchars($item['menu_name']); ?>">
                <h3><?php echo htmlspecialchars($item['menu_name']); ?></h3>
                <p><?php echo htmlspecialchars($item['description']); ?></p>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="menu_id" value="<?php echo htmlspecialchars($item['menu_id']); ?>">
                    <input type="hidden" name="menu_name" value="<?php echo htmlspecialchars($item['menu_name']); ?>">
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($item['price']); ?>">
                    <label for="quantity_<?php echo $item['menu_id']; ?>">Quantity:</label>
                    <input 
                        type="number" 
                        id="quantity_<?php echo $item['menu_id']; ?>" 
                        name="quantity" 
                        class="quantity-input" 
                        min="1" 
                        max="<?php echo htmlspecialchars($item['quantity']); ?>" 
                        value="1">
                    <button type="submit" class="add-to-cart">Add To Cart</button>
                    <span class="price">₱<?php echo number_format($item['price'], 2); ?></span>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="total-amount-btn">
        <a href="cartTable.php" class="basket-btn" id="basket-total">
            Basket <i>•</i> ₱<?php echo number_format($_SESSION['total_cost'], 2); ?>
        </a>
    </div>
</div>
<script src="main.js"></script>
</body>
</html>
