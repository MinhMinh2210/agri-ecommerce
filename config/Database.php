<?php
class Database {
    private $host = "localhost";
    private $db_name = "test";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    /**
     * Thực thi câu lệnh SQL thao tác dữ liệu (INSERT, UPDATE, DELETE)
     */
    public function execute($sql, ...$args) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($args);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Thực thi câu lệnh SQL truy vấn dữ liệu (SELECT)
     */
    public function query($sql, ...$args) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Thực thi câu lệnh SQL truy vấn một bản ghi
     */
    public function queryOne($sql, ...$args) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Thực thi câu lệnh SQL truy vấn một giá trị
     */
    public function queryValue($sql, ...$args) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? array_values($row)[0] : null;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
?>
