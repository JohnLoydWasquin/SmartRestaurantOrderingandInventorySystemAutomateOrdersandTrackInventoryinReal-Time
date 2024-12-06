<?php
require_once '../DATABASE/mainDB.php';

class UsersProfile {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function updateProfile($userId, $firstName, $lastName, $email, $phoneNumber, $profilePicture = null) {
        try {
            $updateQuery = "UPDATE Users SET firstName = ?, lastName = ?, email = ?, PhoneNumber = ?";
            
            if ($profilePicture) {
                $updateQuery .= ", profile_picture = ?";
            }
            $updateQuery .= " WHERE user_id = ?";
    
            $stmt = $this->conn->prepare($updateQuery);
    
            // Bind parameters
            if ($profilePicture) {
                $stmt->bind_param(
                    'sssssi',
                    $firstName,
                    $lastName,
                    $email,
                    $phoneNumber,
                    $profilePicture,
                    $userId
                );
            } else {
                $stmt->bind_param(
                    'ssssi',
                    $firstName,
                    $lastName,
                    $email,
                    $phoneNumber,
                    $userId
                );
            }
    
            // Execute query
            if ($stmt->execute()) {
                if (session_status() === PHP_SESSION_ACTIVE) {
                    $_SESSION['firstName'] = $firstName;
                    $_SESSION['lastName'] = $lastName;
                    $_SESSION['email'] = $email;
                    $_SESSION['PhoneNumber'] = $phoneNumber;
                    if ($profilePicture) {
                        $_SESSION['profilePicture'] = $profilePicture;
                    }
                }
                return true;
            } else {
                return "Error: Could not execute update.";
            }
        } catch (mysqli_sql_exception $e) {
            return "Database Error: " . $e->getMessage();
        }
    }    
}
?>
