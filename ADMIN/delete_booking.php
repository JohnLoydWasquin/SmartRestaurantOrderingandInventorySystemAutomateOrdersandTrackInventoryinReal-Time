<?php
include 'DashboardFunctions.php'; // Include the DashboardFunctions class

// Initialize the class
$dashboardFunctions = new DashboardFunctions();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_booking_id'])) {
    $bookingId = intval($_POST['delete_booking_id']);
    $dashboardFunctions->deleteBooking($bookingId); // Call the method in DashboardFunctions to delete the booking
    header("Location: manage_tables.php"); // Redirect back to manage tables page
    exit();
}
?>
