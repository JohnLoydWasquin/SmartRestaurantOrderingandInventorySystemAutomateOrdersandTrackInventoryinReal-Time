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
        return $result->fetch_assoc()['totalUsers'];
    }

    // Fetch total revenue
    public function getTotalRevenue() {
        $query = "SELECT SUM(total) AS totalRevenue FROM menusbenta"; // Adjust column name
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['totalRevenue'] ?? 0;
    }

    // Fetch new orders
    public function getPopulatItem() {
        $query = "SELECT menu_name, SUM(quantity) AS total_sold
        FROM menusbenta
        GROUP BY menu_id
        ORDER BY total_sold DESC
        LIMIT 1;";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['menu_name'];
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
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['loyalCustomer'];
        } else {
            return null; // No loyal customer found
        }
    }
}
