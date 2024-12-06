<?php
require_once '../DATABASE/mainDB.php';

class DashboardFunctions {
    private $conn;

    public function __construct() {
        // Assuming Database is a class that provides the connection
        $db = new Database();
        $this->conn = $db->getConnection();  // Establish the database connection
    }

    // Fetch total users
    public function getTotalUsers() {
        $query = "SELECT COUNT(*) AS totalUsers FROM Users";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error); // Handle query failure
        }

        $row = $result->fetch_assoc();
        return $row ? $row['totalUsers'] : 0;  // Return the totalUsers count
    }

    // Fetch total revenue
    public function getTotalRevenue() {
        $query = "SELECT SUM(total) AS totalRevenue FROM menusbenta"; // Adjust column name
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['totalRevenue'] ?? 0;
    }

    // Fetch popular item
    public function getPopulatItem() {
        $query = "SELECT menu_name, SUM(quantity) AS total_sold
                  FROM menusbenta
                  GROUP BY menu_id
                  ORDER BY total_sold DESC
                  LIMIT 1;";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['menu_name'] ?? null;
    }

    // Fetch Loyal Customer
    public function getLoyalty() {
        $query = "SELECT u.firstName AS loyalCustomer, COUNT(m.menu_id) AS totalOrders
                  FROM users u
                  JOIN menusbenta m ON u.user_id = m.user_id
                  GROUP BY u.user_id
                  ORDER BY totalOrders DESC
                  LIMIT 1";
        $result = $this->conn->query($query);

        return ($result && $result->num_rows > 0) ? $result->fetch_assoc()['loyalCustomer'] : null;
    }

    // Get Booked Table Inventory
    public function getBookedTables() {
        try {
            $sql = "SELECT * FROM bookings";  // Assuming you're getting the bookings data here
            $stmt = $this->conn->query($sql);
    
            if ($stmt === false) {
                throw new Exception("Query failed: " . $this->conn->error);  // Error handling
            }
    
            $bookedTables = [];
            while ($row = $stmt->fetch_assoc()) {
                $tableNumber = $row['table_number'];  // Assuming 'table_number' is a column in 'bookings'
    
                // Group rows by table number
                $bookedTables[$tableNumber][] = $row;
            }
    
            return $bookedTables;
    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();  // Error handling
            return [];
        }
    }
    
    // Delete booking and update table status
    public function deleteBooking($bookingId) {
        try {
            // Get the table number associated with the booking
            $sqlGetTableNumber = "SELECT table_number FROM bookings WHERE booking_id = ?";
            $stmt = $this->conn->prepare($sqlGetTableNumber);
            $stmt->bind_param("i", $bookingId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $tableNumber = $row['table_number'];

                // Delete the booking from the bookings table
                $sqlDelete = "DELETE FROM bookings WHERE booking_id = ?";
                $stmtDelete = $this->conn->prepare($sqlDelete);
                $stmtDelete->bind_param("i", $bookingId);
                $stmtDelete->execute();

                // Update the table status to not occupied
                $sqlUpdateTable = "UPDATE tables SET is_occupied = 0 WHERE table_number = ?";
                $stmtUpdateTable = $this->conn->prepare($sqlUpdateTable);
                $stmtUpdateTable->bind_param("i", $tableNumber);
                $stmtUpdateTable->execute();

                echo "Booking deleted successfully and table status updated.";
            } else {
                throw new Exception("Booking not found.");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
