<?php
include 'booking.php';

$query = "SELECT table_number, is_occupied FROM tables";
$result = $conn->query($query);

$tables = [];
while ($row = $result->fetch_assoc()) {
    $tables[] = $row;
}

header('Content-Type: application/json');
echo json_encode($tables);
?>
