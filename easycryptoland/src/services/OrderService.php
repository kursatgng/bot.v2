<?php
require_once '../../src/models/Order.php';
require_once '../../src/models/Balance.php';

class OrderService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function buyOrder($user_id, $amount, $price) {
        $balance = new Balance($this->db);
        $userBalance = $balance->getBalance($user_id, 'USDT')['amount'];

        $totalCost = $amount * $price;
        if ($userBalance < $totalCost) {
            return "Yetersiz bakiye.";
        }

        $order = new Order($this->db);
        $order->user_id = $user_id;
        $order->amount = $amount;
        $order->price = $price;
        $order->type = 'buy';

        if ($order->create()) {
            $newBalance = $userBalance - $totalCost;
            $balance->updateBalance($user_id, 'USDT', $newBalance);
            return "Alış emri başarıyla oluşturuldu.";
        }

        return "Alış emri oluşturulamadı.";
    }

    public function sellOrder($user_id, $amount, $price) {
        $balance = new Balance($this->db);
        $userBalance = $balance->getBalance($user_id, 'EasyToken')['amount'];

        if ($userBalance < $amount) {
            return "Yetersiz bakiye.";
        }

        $order = new Order($this->db);
        $order->user_id = $user_id;
        $order->amount = $amount;
        $order->price = $price;
        $order->type = 'sell';

        if ($order->create()) {
            $newBalance = $userBalance - $amount;
            $balance->updateBalance($user_id, 'EasyToken', $newBalance);
            return "Satış emri başarıyla oluşturuldu.";
        }

        return "Satış emri oluşturulamadı.";
    }

    public function getUserOrders($user_id) {
        // Kullanıcının tüm alış/satış emirlerini getirir
    }

    public function processOrderBook() {
        // Emir defterini işler ve eşleşen emirleri tamamlar
    }
}
?>
