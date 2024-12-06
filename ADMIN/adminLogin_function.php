<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../DATABASE/mainDB.php';

class Admin {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function login($email, $password) {
        $password = md5($password);
        $conn = $this->db->getConnection();
    
        // Check if the user exists with the Admin role
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row['role'] === 'Admin') {
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['fullName'] = $row['firstName'] . ' ' . $row['lastName'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];
                return true; // Admin login successful
            } else {
                return "Access Denied";
            }
        } else {
            return false;
        }
    }
}

$db = new Database();
$admin = new Admin($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginResult = $admin->login($email, $password);

    if ($loginResult === true) {
        header("Location: ../ADMIN/dashboard_panel.php");
        exit();
    } elseif ($loginResult === "Access Denied") {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'Only administrators can access this page.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '../ADMIN/adminLogin.php'; // Redirect back to the login page
        });
        </script>
        </body>
        </html>";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Invalid email or password. Please try again.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '../ADMIN/adminLogin.php'; // Redirect back to the login page
        });
        </script>
        </body>
        </html>";
    }
}
?>
