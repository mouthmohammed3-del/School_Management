<?php
class Database {
    private $host = "localhost";
    private $db_name = "shool_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }
}

// إنشاء كائن قاعدة البيانات
$database = new Database();
$db = $database->getConnection();
?>