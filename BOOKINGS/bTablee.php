<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "samgyup_paradise";


$conn = new mysqli($servername, $username, $password, $dbname);




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $table_number = intval($_POST['selectedTable']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $booking_date = htmlspecialchars($_POST['booking_date']);
    $booking_time = htmlspecialchars($_POST['booking_time']);
    $additional_notes = htmlspecialchars($_POST['additional_notes']);

   
    $stmt = $conn->prepare("SELECT is_occupied FROM tables WHERE table_number = ?");
    $stmt->bind_param("i", $table_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $table = $result->fetch_assoc();
    

    if (!$table || $table['is_occupied']) {
        echo json_encode(['success' => false, 'message' => "The selected table is already occupied or does not exist."]);
        exit;
    }

    
$stmt = $conn->prepare(
    "INSERT INTO bookings (first_name, last_name, email, phone, booking_date, booking_time, additional_notes, table_number) 
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssssssi", $first_name, $last_name, $email, $phone, $booking_date, $booking_time, $additional_notes, $table_number);

if ($stmt->execute()) {
    
    $stmt = $conn->prepare("UPDATE tables SET is_occupied = 1 WHERE table_number = ?");
$stmt->bind_param("i", $table_number);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => "Table booked and marked as occupied successfully!"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Failed to mark the table as occupied. Table number might not exist."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Error executing UPDATE query: " . $conn->error]);
}
}


}

?>