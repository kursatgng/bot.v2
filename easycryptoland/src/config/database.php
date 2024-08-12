<?php
class Database {
    private $host = "localhost1"; //örnek
    private $db_name = "easycryptoland";//örnek
    private $username = "root";//örnek
    private $password = "111111"; //örnek
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
