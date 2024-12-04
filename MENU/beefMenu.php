<?php
session_start();
require_once '../DATABASE/mainDB.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=samgyup_paradise", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT menu_id, menu_name, description, price, category, quantity FROM menus WHERE category = 'Beef'");
    $stmt->execute();
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($menu_items)) {
        $menu_items = [
            [
                'menu_id' => 1,
                'menu_name' => 'Beef Samgyup',
                'description' => 'Thinly sliced beef.',
                'price' => 199,
                'category' => 'Beef',
                'quantity' => 255
            ],
            [
                'menu_id' => 2,
                'menu_name' => 'Yangnyum Beef',
                'description' => 'Marinated beef slices coated in a sweet and savory sauce.',
                'price' => 549,
                'category' => 'Beef',
                'quantity' => 255
            ],
            [
                'menu_id' => 3,
                'menu_name' => 'Bulgogi',
                'description' => 'Thin & tender slices of beef marinated in a sweet soy-based sauce.',
                'price' => 549,
                'category' => 'Beef',
                'quantity' => 255
            ],
            [
                'menu_id' => 4,
                'menu_name' => 'Beef Enoki',
                'description' => 'Thinly sliced beef and enoki mushrooms wrapped together.',
                'price' => 499,
                'category' => 'Beef',
                'quantity' => 255
            ]
        ];
    }
} catch (PDOException $e) {
    $menu_items = [
        [
            'menu_id' => 1,
            'menu_name' => 'Beef Samgyup',
            'description' => 'Thinly sliced beef.',
            'price' => 199,
            'category' => 'Beef',
            'quantity' => 255
        ],
        [
            'menu_id' => 2,
            'menu_name' => 'Yangnyum Beef',
            'description' => 'Marinated beef slices coated in a sweet and savory sauce.',
            'price' => 549,
            'category' => 'Beef',
            'quantity' => 255
        ],
        [
            'menu_id' => 3,
            'menu_name' => 'Bulgogi',
            'description' => 'Thin & tender slices of beef marinated in a sweet soy-based sauce.',
            'price' => 549,
            'category' => 'Beef',
            'quantity' => 255
        ],
        [
            'menu_id' => 4,
            'menu_name' => 'Beef Enoki',
            'description' => 'Thinly sliced beef and enoki mushrooms wrapped together.',
            'price' => 499,
            'category' => 'Beef',
            'quantity' => 255
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../MAIN/style.css">
    <link rel="icon" type="image/x-icon" href="../websiteImage/LogoFP.webp">
    <title>Beef Menu - Samgyup Paradise</title>
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
                        <a href="../MAIN/bTable.php">
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
                    <a href="../MAIN/main.html">
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
                    <a href="../MAIN/bTable.php">
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

<div class="menu-section" id="menu">
    <h1>UNLI <span>SAMGYUPSAL</span> MENU</h1>
    <div class="menu-category">
        <span class="category-label">BEEF MENU</span>
    </div>
    <div class="menu-items">
        <?php foreach ($menu_items as $item): ?>
            <div class="menu-item">
                <img src="../websiteImage/beefmenu<?php echo $item['menu_id']; ?>.png" alt="<?php echo htmlspecialchars($item['menu_name']); ?>">
                <h3><?php echo htmlspecialchars($item['menu_name']); ?></h3>
                <p><?php echo htmlspecialchars($item['description']); ?></p>
                <form action="../MENU/add_to_cart.php" method="POST">
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
                        <button 
                            type="button" 
                            class="add-to-cart" 
                            onclick="addToCart(
                                <?php echo htmlspecialchars($item['menu_id']); ?>, 
                                '<?php echo addslashes($item['menu_name']); ?>', 
                                <?php echo htmlspecialchars($item['price']); ?>, 
                                document.getElementById('quantity_<?php echo htmlspecialchars($item['menu_id']); ?>').value
                            )">
                            Add To Cart
                        </button>
                    <span class="price">₱<?php echo number_format($item['price'], 2); ?></span>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="total-amount-btn">
        <a href="../MENU/cartTable.php" class="basket-btn" id="basket-total">
            Basket <i>•</i> ₱<?php echo number_format($_SESSION['total_cost'], 2); ?>
        </a>
    </div>
</div>
<script src="../MAIN/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function addToCart(menu_id, menu_name, price, quantity = 1) {
    $.ajax({
        url: '../MENU/add_to_cart.php',
        type: 'POST',
        data: {
            menu_id: menu_id,
            menu_name: menu_name,
            price: price,
            quantity: quantity
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.total_cost) {
                document.getElementById("basket-total").innerText = `Total: ₱${data.total_cost}`;
            }
        },
        error: function() {
            alert("There was an error adding the item to the cart.");
        }
    });
}
</script>
</body>
</html>
