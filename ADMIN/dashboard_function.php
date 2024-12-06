<?php
require_once '../DATABASE/mainDB.php';

class DashboardFunctions {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Fetch total users
    public function getTotalUsers() {
        $query = "SELECT COUNT(*) AS totalUsers FROM Users";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error); 
        }

        $row = $result->fetch_assoc();
        return $row ? $row['totalUsers'] : 0; 
    }

    // Fetch total revenue
    public function getTotalRevenue() {
        $query = "SELECT SUM(total) AS totalRevenue FROM menusbenta"; 
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
            $sql = "SELECT * FROM bookings"; 
            $stmt = $this->conn->query($sql);
    
            if ($stmt === false) {
                throw new Exception("Query failed: " . $this->conn->error); 
            }
    
            $bookedTables = [];
            while ($row = $stmt->fetch_assoc()) {
                $tableNumber = $row['table_number']; 
    
                $bookedTables[$tableNumber][] = $row;
            }
    
            return $bookedTables;
    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage(); 
            return [];
        }
    }
    
    public function deleteBooking($bookingId) {
        try {
            $sqlGetTableNumber = "SELECT table_number FROM bookings WHERE booking_id = ?";
            $stmt = $this->conn->prepare($sqlGetTableNumber);
            $stmt->bind_param("i", $bookingId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $tableNumber = $row['table_number'];

                $sqlDelete = "DELETE FROM bookings WHERE booking_id = ?";
                $stmtDelete = $this->conn->prepare($sqlDelete);
                $stmtDelete->bind_param("i", $bookingId);
                $stmtDelete->execute();

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
