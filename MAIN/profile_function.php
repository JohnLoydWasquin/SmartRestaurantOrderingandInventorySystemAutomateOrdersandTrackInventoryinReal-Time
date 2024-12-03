<?php
require_once '../DATABASE/mainDB.php';

class UsersProfile {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection(); // Initialize the connection
    }

    public function updateProfile($userId, $firstName, $lastName, $email, $phoneNumber, $profilePicture = null) {
        try {
            // Base query
            $updateQuery = "UPDATE Users SET firstName = ?, lastName = ?, email = ?, phoneNumber = ?";
            
            // Include profile picture if provided
            if ($profilePicture) {
                $updateQuery .= ", profile_picture = ?";
            }
            $updateQuery .= " WHERE user_id = ?";
    
            // Prepare statement
            $stmt = $this->conn->prepare($updateQuery);
    
            // Bind parameters
            if ($profilePicture) {
                $stmt->bind_param(
                    'sssssi', // Types: s = string, i = integer
                    $firstName,
                    $lastName,
                    $email,
                    $phoneNumber,
                    $profilePicture,
                    $userId
                );
            } else {
                $stmt->bind_param(
                    'ssssi', // Types: s = string, i = integer
                    $firstName,
                    $lastName,
                    $email,
                    $phoneNumber,
                    $userId
                );
            }
    
            // Execute query
            if ($stmt->execute()) {
                // Update session variables if session is active
                if (session_status() === PHP_SESSION_ACTIVE) {
                    $_SESSION['firstName'] = $firstName;
                    $_SESSION['lastName'] = $lastName;
                    $_SESSION['email'] = $email;
                    $_SESSION['phoneNumber'] = $phoneNumber;
                    if ($profilePicture) {
                        $_SESSION['profilePicture'] = $profilePicture;
                    }
                }
                return true;
            } else {
                return "Error: Could not execute update.";
            }
        } catch (mysqli_sql_exception $e) {
            // Handle exceptions
            return "Database Error: " . $e->getMessage();
        }
    }    
}
?>
