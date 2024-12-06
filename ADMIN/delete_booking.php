<?php
include 'DashboardFunctions.php'; // Include the DashboardFunctions class

$dashboardFunctions = new DashboardFunctions();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_booking_id'])) {
    $bookingId = intval($_POST['delete_booking_id']);
    $dashboardFunctions->deleteBooking($bookingId);
    header("Location: manage_tables.php"); 
    exit();
}
?>
