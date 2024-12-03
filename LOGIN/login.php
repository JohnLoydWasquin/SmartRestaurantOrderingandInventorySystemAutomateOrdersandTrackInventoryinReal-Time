<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../DATABASE/mainDB.php';

class User {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function register($fName, $lName, $phoneNumber, $email, $password) {
        $password = md5($password);
        $conn = $this->db->getConnection();

        // Check if yung email ay nag eexist na
        $checkEmailQuery = "SELECT * FROM Users WHERE email = ?";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "The email already exists!";
        }

        $insertQuery = "INSERT INTO Users (firstName, lastName, PhoneNumber, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssss", $fName, $lName, $phoneNumber, $email, $password);

        if ($stmt->execute()) {
            return true; // Registration successful
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function login($email, $password) {
        $password = md5($password);
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM Users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
            $_SESSION['fullName'] = $row['firstName'] . ' ' . $row['lastName']; // Combine first and last name
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['profilePicture'] = !empty($row['profile_picture']) ? $row['profile_picture'] : 'websiteImage/default.png'; // Set a default if none exists // Assuming 'user_id' is the user ID column
            return true; // Login successful
        } else {
            return false; // Login failed
        }
    }    
}

$db = new Database();
$user = new User($db);

if (isset($_POST['signUp'])) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $phoneNumber = $_POST['tNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $user->register($fName, $lName, $phoneNumber, $email, $password);

    if ($result === true) {
        header("Location: ../LOGIN/login.html");
        exit();
    } else {
        echo "<h1>$result</h1>";
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password)) {
        header("Location: ../MAIN/main.php");
        exit();
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
            title: 'Error!',
            text: 'Incorrect password or email. Try again!',
            icon: 'error',
            confirmButtonText: 'Okay'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../LOGIN/login.html';
            }
        });
        </script>
        </body>
        </html>";
    }    
}
?>
