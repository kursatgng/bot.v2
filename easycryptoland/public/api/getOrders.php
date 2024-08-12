<?php
require_once '../../src/config/database.php';
require_once '../../src/services/OrderService.php';

$user_id = 1; // Örnek oturum açmış kullanıcı

$orderService = new OrderService($db);
$orders = $orderService->getUserOrders($user_id);

echo json_encode($orders);
?>
