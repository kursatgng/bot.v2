<?php
class Order {
    private $conn;
    private $table_name = "orders";

    public $id;
    public $user_id;
    public $amount;
    public $price;
    public $type;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, amount=:amount, price=:price, type=:type, status='pending'";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":type", $this->type);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateStatus($status) {
        $query = "UPDATE " . $this->table_name . " SET status=:status WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
