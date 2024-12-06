<?php
require_once '../DATABASE/mainDB.php';
require_once '../MAIN/profile_function.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in the session
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $profilePicture = null;

    // Handle profile picture upload
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../websiteImage/';
        $fileName = basename($_FILES['profilePicture']['name']);
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $filePath)) {
            $profilePicture = $filePath;
        } else {
            echo "Error uploading the profile picture.";
            exit;
        }
    }

    // Instantiate UsersProfile and call updateProfile
    $userProfile = new UsersProfile();
    $updateResult = $userProfile->updateProfile($userId, $firstName, $lastName, $email, $phoneNumber, $profilePicture);

    if ($updateResult === true) {
        header('Location: ../MAIN/profile.php?success=1');
        exit;
    } else {
        echo "Error updating profile: " . $updateResult;
    }
}
?>
