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
                'menu_name' => 'Dae-Pae',
                'description' => 'Thinly sliced, flavorful pork belly strips.',
                'price' => 549,
                'category' => 'Pork',
                'quantity' => 255
            ],
            [
                'menu_id' => 2,
                'menu_name' => 'Buljib',
                'description' => 'Tenderized fresh pork belly with a honeycomb cut.',
                'price' => 249,
                'category' => 'Pork',
                'quantity' => 255
            ],
            [
                'menu_id' => 3,
                'menu_name' => 'YangnyumDae-pae',
                'description' => 'Marinated in a sweet & spicy sauce.',
                'price' => 549,
                'category' => 'Pork',
                'quantity' => 255
            ],
            [
                'menu_id' => 4,
                'menu_name' => 'YangnyumBuljib',
                'description' => 'Marinated in a sweet & spicy sauce.',
                'price' => 349,
                'category' => 'Pork',
                'quantity' => 255
            ],
            [
                'menu_id' => 5,
                'menu_name' => 'Gochujang',
                'description' => 'Marinated in a fermented red chili paste.',
                'price' => 200,
                'category' => 'Pork',
                'quantity' => 255
            ],
            [
                'menu_id' => 6,
                'menu_name' => 'Moksal',
                'description' => 'A leaner texture with a more intense porky flavor.',
                'price' => 449,
                'category' => 'Pork',
                'quantity' => 255
            ],
            [
                'menu_id' => 7,
                'menu_name' => 'MoksalYangnyum',
                'description' => 'A marinated pork neck meat in a sweet and savory sauce.',
                'price' => 400,
                'category' => 'Pork',
                'quantity' => 255
            ]
        ];
    }
} catch (PDOException $e) {
    $menu_items = [
        [
            'menu_id' => 1,
            'menu_name' => 'Dae-Pae',
            'description' => 'Thinly sliced, flavorful pork belly strips.',
            'price' => 549,
            'category' => 'Pork',
            'quantity' => 255
        ],
        [
            'menu_id' => 2,
            'menu_name' => 'Buljib',
            'description' => 'Tenderized fresh pork belly with a honeycomb cut.',
            'price' => 249,
            'category' => 'Pork',
            'quantity' => 255
        ],
        [
            'menu_id' => 3,
            'menu_name' => 'YangnyumDae-pae',
            'description' => 'Marinated in a sweet & spicy sauce.',
            'price' => 549,
            'category' => 'Pork',
            'quantity' => 255
        ],
        [
            'menu_id' => 4,
            'menu_name' => 'YangnyumBuljib',
            'description' => 'Marinated in a sweet & spicy sauce.',
            'price' => 349,
            'category' => 'Pork',
            'quantity' => 255
        ],
        [
            'menu_id' => 5,
            'menu_name' => 'Gochujang',
            'description' => 'Marinated in a fermented red chili paste.',
            'price' => 200,
            'category' => 'Pork',
            'quantity' => 255
        ],
        [
            'menu_id' => 6,
            'menu_name' => 'Moksal',
            'description' => 'A leaner texture with a more intense porky flavor.',
            'price' => 449,
            'category' => 'Pork',
            'quantity' => 255
        ],
        [
            'menu_id' => 7,
            'menu_name' => 'MoksalYangnyum',
            'description' => 'A marinated pork neck meat in a sweet and savory sauce.',
            'price' => 400,
            'category' => 'Pork',
            'quantity' => 255
        ]
];
    error_log("Database connection failed: " . $e->getMessage());
}

// Initialize total_cost if not set
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/x-icon" href="websiteImage/LogoFP.webp">
    <title>Unlimited menu - Samgyup Paradise</title>
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
                        <a href="menu.php">Menu</a>
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
                        <a href="menu.php">Menu</a>
                        <ul class="dropdown">
                            <li><a href="menu.php">Pork Menu</a></li>
                            <li><a href="beefMenu.php">Beef Menu</a></li>
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

    <div class="menu-section" id="menu">
        <h1>UNLI <span>SAMGYUPSAL</span> MENU</h1>
        <div class="menu-category">
        <span class="category-label">PORK MENU</span>
        </div>
        <div class="menu-items">
        <?php foreach ($menu_items as $item): ?>
            <div class="menu-item">
            <img src="websiteImage/porkmenu<?php echo $item['menu_id']; ?>.png" alt="<?php echo htmlspecialchars($item['menu_name']); ?>">
                <h3><?php echo htmlspecialchars($item['menu_name']); ?></h3>
                <p><?php echo htmlspecialchars($item['description']); ?></p>
                <form action="add_to_cart.php" method="POST" id="menus">
                    <input type="hidden" name="menu_id" value="<?php echo htmlspecialchars($item['menu_id']); ?>">
                    <input type="hidden" name="menu_name" value="<?php echo htmlspecialchars($item['menu_name']); ?>">
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($item['price']); ?>">
                    <input type="hidden" name="description" value="<?php echo htmlspecialchars($item['description']); ?>">
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($item['category']); ?>">
                    <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                    <button type="submit" class="add-to-cart">Add To Cart</button>
                    <span class="price">₱<?php echo number_format($item['price'], 2); ?></span>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="total-amount-btn">
        <button class="basket-btn" id="basket-total">Basket <i>•</i> ₱<?php echo number_format($_SESSION['total_cost'] ?? 0, 2); ?></button>
        </div>
    </div>
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
function addToCart(menu_id, menu_name, price, quantity = 1) {
    $.ajax({
        url: 'add_to_cart.php',
        type: 'POST',
        data: {
            menu_id: menu_id,
            menu_name: menu_name,
            price: price,
            quantity: quantity
        },
        success: function(response) {
            // Parse the JSON response
            const data = JSON.parse(response);

            // Update the total cost in the basket button
            if (data.total_cost) {
                document.getElementById("basket-total").innerText = `Total: $${data.total_cost}`;
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