<?php
class Database {
    private $host = 'localhost';
    private $db = 'mydatabase';
    private $user = 'shahriyar';
    private $pass = 'pass';
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function executeQuery($sql) {
        $result = $this->conn->query($sql);
        
        if ($result === false) {
            die("Query execution failed: " . $this->conn->error);
        }

        if (stripos($sql, 'SELECT') === 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $this->conn->affected_rows;
        }

    
    }
}
