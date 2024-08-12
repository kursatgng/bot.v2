<?php
class Trade {
    private $conn;
    private $table_name = "trades";

    public $id;
    public $buy_order_id;
    public $sell_order_id;
    public $amount;
    public $price;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET buy_order_id=:buy_order_id, sell_order_id=:sell_order_id, amount=:amount, price=:price";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":buy_order_id", $this->buy_order_id);
        $stmt->bindParam(":sell_order_id", $this->sell_order_id);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":price", $this->price);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
