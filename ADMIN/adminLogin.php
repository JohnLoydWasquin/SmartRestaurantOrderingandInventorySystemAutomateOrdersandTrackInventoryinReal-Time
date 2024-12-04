<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #ffe8dd;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    }

    .back-button {
        position: fixed;
        top: 20px;
        left: 20px;
        background-color: #ff4500;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        background-color: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(255, 69, 0, 0.2);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    h1 {
        color: #333;
        margin-bottom: 2rem;
        font-size: 2rem;
    }

    .input-group {
        margin-bottom: 1.5rem;
        text-align: left;
    }

    input {
        width: 100%;
        padding: 0.75rem 0;
        border: none;
        border-bottom: 1px solid #ddd;
        outline: none;
        font-size: 1rem;
    }

    .recover-link {
        display: block;
        text-align: right;
        color: #666;
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .sign-in-btn {
        width: 100%;
        padding: 1rem;
        background-color: #ff4500;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
        color: #666;
    }

    .divider::before,
    .divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #ddd;
    }

    .divider span {
        padding: 0 10px;
    }
    </style>
</head>
<body>
    <button class="back-button">←</button>
    
    <div class="login-container">
        <h1>Admin Login</h1>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="../ADMIN/admin_login.php" method="POST">
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <a href="#" class="recover-link">Recover Password</a>
            
            <button type="submit" class="sign-in-btn">Sign In</button>
        </form>    
    </div>
</body>
</html>