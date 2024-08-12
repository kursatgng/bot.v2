<?php
require_once '../../src/models/Trade.php';
require_once '../../src/models/Order.php';
require_once '../../src/models/Balance.php';

class TradeService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function executeTrade($buy_order, $sell_order) {
        $trade = new Trade($this->db);
        $trade->buy_order_id = $buy_order['id'];
        $trade->sell_order_id = $sell_order['id'];
        $trade->amount = min($buy_order['amount'], $sell_order['amount']);
        $trade->price = $sell_order['price'];

        if ($trade->create()) {
            $order = new Order($this->db);
            $order->id = $buy_order['id'];
            $order->updateStatus('completed');

            $order->id = $sell_order['id'];
            $order->updateStatus('completed');

            $balance = new Balance($this->db);
            $balance->updateBalance($buy_order['user_id'], 'EasyToken', $trade->amount);
            $balance->updateBalance($sell_order['user_id'], 'USDT', $trade->amount * $trade->price);

            return "Trade executed successfully.";
        }

        return "Trade execution failed.";
    }
}
?>
